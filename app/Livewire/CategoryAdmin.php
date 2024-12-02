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
    public $valueIdParentCategory = '';
    public $valueStatus = 'active';
    public $dataEditCategory;
    public function mount()
    {
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
        // foreach ($this->getAllCategory as $value) {
        //     $this->dataIdCategoryParent = CategoryProduct::where('id', $value->parent_id)->get();
        // }
        foreach ($this->getAllCategory as $value) {
            // Lấy dữ liệu của category cha
            if (!empty($value->parent_id)) {
                $parentCategory = CategoryProduct::find($value->parent_id); // Tìm parent theo ID
                if ($parentCategory) {
                    $this->dataIdCategoryParent[$value->id] = $parentCategory; // Gán vào mảng với key là ID category
                }
            }
        }
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
            $this->dispatch('toast', message: 'Xóa danh mục thành công.', notify: 'success');
            $this->loadCategory();
        } catch (\Throwable $th) {
            $this->dispatch('toast', message: 'Xóa danh mục không thành công.', notify: 'error');
        }
    }
    public function closeModal()
    {
        $this->dataEditCategory = [];
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
            'imageCategory' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ], [
            'imageCategory.required' => 'Ảnh đại diện là bắt buộc.',
            'imageCategory.image' => 'Ảnh đại diện phải là một hình ảnh.',
            'imageCategory.mimes' => 'Ảnh đại diện phải có định dạng jpeg, png, jpg, gif, hoặc svg.',
            'imageCategory.max' => 'Ảnh đại diện không được lớn hơn 2048 KB.',
        ]);
        try {
            // Kiểm tra và tạo thư mục nếu chưa tồn tại
            $fileName = time() . '_' . $value->getClientOriginalName();
            $value->storeAs('uploads', $fileName, 'public');
            $this->imageCategory = '';
            $this->imageCategory = $fileName;
            $this->dispatch('toast', message: 'Thêm ảnh danh mục thành công.', notify: 'success');
        } catch (\Exception $th) {
            $this->dispatch('toast', message: 'Không thể cập nhật ảnh danh mục. Vui lòng thử lại.', notify: 'error');
        }
    }
    public function removeImage()
    {
        if ($this->imageCategory !== '' && Storage::disk('public')->exists('uploads/' . $this->imageCategory)) {
            // Xóa hình ảnh khỏi thư mục
            Storage::disk('public')->delete(paths: 'uploads/' . $this->imageCategory);
            $this->dispatch('toast', message: 'Xóa hình danh mục thành công.', notify: 'success');
        }
        // Reset giá trị về mặc định
        $this->imageCategory = '';
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
                'parent_id' => $this->valueIdParentCategory === '' ? null : $this->valueIdParentCategory,
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
            $this->dispatch('toast', message: 'Thêm danh mục thành công.', notify: 'success');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $this->isModal = false;
            $this->dispatch('toast', message: 'Thêm danh mục thất bại.', notify: 'error');
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
            $this->dispatch('toast', message: 'Cập nhật danh mục thành công.', notify: 'success');
        } catch (\Throwable $th) {
            $this->dispatch('toast', message: 'Cập nhật danh mục thất bại.', notify: 'error');
        }
    }
    public function render()
    {
        return view('livewire.category-admin');
    }
}