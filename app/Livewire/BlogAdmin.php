<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlogModel;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogAdmin extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $getposts  = [];
    public $paginationData;
    public $id = '';
    public $title = '';
    public $post_type = '';
    public $isModal = false;
    public $image = '';
    public $slug = '';
    public $Type='Review';
    public $Content = '';
    
    #[Validate('required', message: 'Tiêu đề bài viết không được để rỗng')]
    public $content = '';
    #[Validate('required', message: 'Nội dung bài viết không được để rỗng')]
   
    
    public $status = 'active';
    public $dataEditpost;

    public function mount()
    {

        $this->loadPosts();
    }
    

    public function loadPosts()
    {
        $query = BlogModel::query()->orderBy('id', 'desc');

      
        $paginator = $query->paginate(20);
        $this->getposts = $paginator->items();
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

    public function updatedIdPost($value)
    {
        $this->id = $value;
        $this->resetPage(); // Quay về trang đầu
        $this->loadPosts();
    }

    public function updatedTitlePost($value)
    {
        $this->title = $value;
        $this->resetPage(); // Quay về trang đầu
        $this->loadPosts();
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
        $this->loadPosts(); // Cập nhật bài viết theo trang hiện tại và bộ lọc
    }

    public function deleted_post($id, $image)
    {
        $this->id = $id;
        $this->image = $image;
        $this->dispatch('swal');
    }

    #[On('hanldeDeletedpost')]
    public function deletedPost()
    {
       
        try {
            BlogModel::destroy($this->id);
            Storage::disk('public')->delete('uploads/' . $this->image);
            $this->image = '';
            $this->loadPosts();
            session()->flash('deleted_success', 'Xóa bài viết thành công');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            session()->flash('deleted_error', 'Xóa bài viết không thành công');
        }
    }

    public function closeModal()
    {
        $this->isModal = !$this->isModal;
        $this->reset([
            'title',
            'image',
            'slug',
            'content',
            'tags',
            
        ]);
        $this->status = 'active';
    }

    public function updatedValueStatus($value)
    {
        $this->status = $value;
    }

    public function updatedImagePost($value)
    {
        $this->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $fileName = time() . '_' . $value->getClientOriginalName();
            $value->storeAs('uploads', $fileName, 'public');
            $this->image = $fileName;
        } catch (\Exception $th) {
            session()->flash('error', 'Không thể cập nhật ảnh bài viết. Vui lòng thử lại.');
        }
    }

    public function removeImage()
    {
        if ($this->image !== '' && Storage::disk('public')->exists('uploads/' . $this->image)) {
            Storage::disk('public')->delete('uploads/' . $this->image);
        }
        $this->image = '';
        session()->flash('removeImageSuccess', 'Hình ảnh đã được xóa thành công.');
    }

    public function updatedValueTitlePost($value)
    {
        $this->slug = Str::slug($value);
    }
    public function updatedType($value){
        dd('ok');
    }
    public function createPost()
    {
        try {
            BlogModel::create([
                'title' => $this->title,
                'image' => $this->image,
                'slug' => $this->slug,
                'content' => $this->content,
                'status' => $this->status,
                'tags'=> $this->tags,
                
            ]);
            $this->reset([
                'title',
                'image',
                'slug',
                'content',
                'tags',
                
            ]);
            $this->status = 'active';
            $this->isModal = false;
            $paginator = BlogModel::orderBy('id', 'desc')->paginate(20);
            $this->getposts = $paginator->items();
            $this->updatePaginationData($paginator);
            session()->flash('create_success', 'Thêm bài viết thành công');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            $this->isModal = false;
            session()->flash('create_error', 'Thêm bài viết thất bại');
        }
    }

    public function editpost($value)
    {
        $this->dataEditpost = BlogModel::find($value);
        $this->id = $value;
        $this->isModal = true;
        $this->post_type = $this->dataEditpost['post_type'];
        // $this->tags = $this->dataEditpost['tags'];
        $this->title = $this->dataEditpost['title'];
        $this->slug = $this->dataEditpost['slug'];
        $this->content= $this->dataEditpost['content'];
        $this->status = $this->dataEditpost['status'];
        $this->image = $this->dataEditpost['image'];
    }

    public function Updatepost()
    {
        
        try {
        
            BlogModel::where('id', $this->id)->update([
                'post_type' => $this->post_type,
                'title' => $this->title,
                'image' => $this->image,
                'slug' => $this->slug,
                'content' => $this->content,
                'status' => $this->status,
                // 'tags' => $this->tags,
                // 'hot' => $this->hot,
                // 'meta_title_seo' => $this->meta_title_seo,
                // 'meta_description_seo' => $this->meta_description_seo,
                
            ]);
            $this->reset([
                'post_type' => $this->post_type,
                'title' => $this->title,
                'image' => $this->image,
                'slug' => $this->slug,
                'content' => $this->content,
                'status' => $this->status,
                // 'tags' => $this->tags,
                // 'hot' => $this->hot,
                // 'meta_title_seo' => $this->meta_title_seo,
                // 'meta_description_seo' => $this->meta_description_seo,
                
            ]);
            $this->status = 'active';
            $this->isModal = false;
            $paginator = BlogModel::orderBy('id', 'desc')->paginate(20);
            $this->getposts = $paginator->items();
            $this->updatePaginationData($paginator);
            session()->flash('update_success', 'Cập nhật bài viết thành công');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            session()->flash('update_error', 'Cập nhật bài viết thất bại');
        }
    }

    public function render()
    {
        return view('livewire.blog-admin');
    }
}
