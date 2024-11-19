<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CategoryProduct;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class CategoryAdmin extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $getAllCategory = [];
    public $paginationData;
    public $idCategory = '';
    public $nameCategory = '';
    public $id_category = '';
    public $isModal = false;
    public $imageCategory = '';
    public $valueSlug = '';
    public $dataIdCategoryParent = [];
    #[Validate('required', message: 'Tên danh mục không được để rỗng')]
    public $valueNameCategory = '';
    #[Validate('required', message: 'Số thứ tự không được để rỗng')]
    #[Validate('numeric', message: 'Số thứ tự chỉ được nhập số')]
    public $valueOrderCategory = '';
    #[Validate('required', message: 'Danh mục cha không được để rỗng')]
    public $valueIdParentCategory = '';
    public $valueStatus = 'active';
    public $dataEditCategory;
    public function mount()
    {
        $this->dataIdCategoryParent = CategoryProduct::get();
        $this->loadCategory();
    }

    public function loadCategory()
    {
        $query = CategoryProduct::query()->orderBy('id', 'desc');

        if (!empty($this->idCategory)) {
            $query->where('id', 'like', '%' . $this->idCategory . '%');
        }
        if (!empty($this->nameCategory)) {
            $query->where('name', 'like', '%' . $this->nameCategory . '%');
        }
        $paginator = $query->paginate(20);
        $this->getAllCategory = $paginator->items();
        $this->updatePaginationData($paginator);
    }
    public function updatePaginationData($paginator)
    {
        $this->paginationData = [
            'currentPage' => $paginator->currentPage(),
            'lastPage' => $paginator->lastPage(),
            'total' => $paginator->total(),
            'perPage' => $paginator->perPage(),
        ];
    }
    public function updatedIdCategory($value)
    {
        $this->idCategory = $value;
        $this->resetPage(); // Quay về trang đầu
        $this->loadCategory();
    }
    public function updatedNameCategory($value)
    {
        $this->nameCategory = $value;
        $this->resetPage(); // Quay về trang đầu
        $this->loadCategory();
    }
    public function previousPage()
    {
        if ($this->paginationData['currentPage'] > 1) {
            $this->gotoPage($this->paginationData['currentPage'] - 1);
        }
    }

    public function nextPage()
    {
        if ($this->paginationData['currentPage'] < $this->paginationData['lastPage']) {
            $this->gotoPage($this->paginationData['currentPage'] + 1);
        }
    }

    public function gotoPage($page)
    {
        $this->setPage($page);
        $this->loadCategory(); // Cập nhật danh sách user theo trang hiện tại và bộ lọc
    }

    public function deleted_category($id, $image)
    {
        $this->id_category = $id;
        $this->imageCategory = $image;
        $this->dispatch('swal');
    }
    #[On('hanldeDeletedCategory')]
    public function deletedCategory()
    {
        try {
            CategoryProduct::destroy($this->id_category);
            Storage::disk('public')->delete(paths: 'uploads/' . $this->imageCategory);
            $this->imageCategory = '';
            $this->loadCategory();
            session()->flash('deleted_success', 'Xóa danh mục thành công');
            $this->loadCategory();
        } catch (\Throwable $th) {
            session()->flash('deleted_error', 'Xóa danh mục không thành công');
        }
    }
    public function closeModal()
    {
        $this->isModal = !$this->isModal;
        $this->reset([
            'valueNameCategory',
            'imageCategory',
            'valueSlug',
            'valueOrderCategory',
            'valueIdParentCategory'
        ]);
        $this->valueStatus = 'active';
    }
    public function updatedValueStatus($value)
    {
        $this->valueStatus = $value;
    }
    public function updatedValueIdParentCategory($value)
    {
        $this->valueIdParentCategory = $value;
    }
    public function updatedImageCategory($value)
    {
        $this->validate([
            'imageCategory' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            $fileName = time() . '_' . $value->getClientOriginalName();
            $value->storeAs('uploads', $fileName, 'public');
            $this->imageCategory = '';
            $this->imageCategory = $fileName;
        } catch (\Exception $th) {
            session()->flash('error', 'Không thể cập nhật ảnh đại diện. Vui lòng thử lại.');
        }
    }
    public function removeImage()
    {
        if ($this->imageCategory !== '' && Storage::disk('public')->exists('uploads/' . $this->imageCategory)) {
            // Xóa hình ảnh khỏi thư mục
            Storage::disk('public')->delete(paths: 'uploads/' . $this->imageCategory);
        }
        // Reset giá trị về mặc định
        $this->imageCategory = '';
        session()->flash('removeImageSuccess', 'Hình ảnh đã được xóa thành công.');
    }
    public function updatedValueNameCategory($value)
    {
        $this->valueSlug = Str::slug($value);
    }
    public function createCategory()
    {
        try {
            CategoryProduct::create([
                'name' => $this->valueNameCategory,
                'image' => $this->imageCategory,
                'slug' => $this->valueSlug,
                'status' => $this->valueStatus,
                'order' => $this->valueOrderCategory,
                'parent_id' => $this->valueIdParentCategory,
            ]);
            $this->reset([
                'valueNameCategory',
                'imageCategory',
                'valueSlug',
                'valueOrderCategory',
                'valueIdParentCategory'
            ]);
            $this->valueStatus = 'active';
            $this->isModal = false;
            $paginator = CategoryProduct::orderBy('id', 'desc')->paginate(20);
            $this->getAllCategory = $paginator->items();
            $this->updatePaginationData($paginator);
            session()->flash('create_success', 'Thêm danh mục thành công');
        } catch (\Throwable $th) {
            session()->flash('create_error', 'Thêm danh mục thất bại');
        }
    }
    public function editCategory($value)
    {
        $this->dataEditCategory = CategoryProduct::find($value);
        $this->id_category = $value;
        $this->isModal = true;
        $this->valueNameCategory =  $this->dataEditCategory['name'];
        $this->valueSlug = $this->dataEditCategory['slug'];
        $this->valueOrderCategory = $this->dataEditCategory['order'];
        $this->valueIdParentCategory = $this->dataEditCategory['parent_id'];
        $this->valueStatus = $this->dataEditCategory['status'];
        $this->imageCategory = $this->dataEditCategory['image'];
    }
    public function UpdateCategory()
    {
        try {
            CategoryProduct::where('id', $this->id_category)->update([
                'name' => $this->valueNameCategory,
                'image' => $this->imageCategory,
                'slug' => $this->valueSlug,
                'status' => $this->valueStatus,
                'order' => $this->valueOrderCategory,
                'parent_id' => $this->valueIdParentCategory,
            ]);
            $this->reset([
                'valueNameCategory',
                'imageCategory',
                'valueSlug',
                'valueOrderCategory',
                'valueIdParentCategory'
            ]);
            $this->valueStatus = 'active';
            $this->isModal = false;
            $paginator = CategoryProduct::orderBy('id', 'desc')->paginate(20);
            $this->getAllCategory = $paginator->items();
            $this->updatePaginationData($paginator);
            session()->flash('update_success', 'Cập nhật danh mục thành công');
        } catch (\Throwable $th) {
            session()->flash('update_error', 'Cập nhật danh mục thất bại');
        }
    }
    public function render()
    {
        return view('livewire.category-admin');
    }
}