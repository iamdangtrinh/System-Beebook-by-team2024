<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Taxonomy;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TaxonomyAdmin extends Component
{
    use WithFileUploads;
    use WithPagination;
    
    public $gettaxonomy = [];
    public $paginationData;
    public $id = '';
    public $type = '';
    public $name = '';
    public $slug = '';
    public $isModal = false;
    public $dataEditTaxonomy;

    public function mount()
    {
        $this->loadTaxonomy();
    }

    public function loadTaxonomy()
    {
        $query = Taxonomy::query()->orderBy('id', 'desc');

      
        $paginator = $query->paginate(20);
        $this->gettaxonomy = $paginator->items();
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
    public function closeModal()
    {
        $this->isModal = !$this->isModal;
        $this->reset([
            'type',
            'name',
            'slug',
        ]);
    }

    private function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $count = TaxonomyAdmin::where('slug', 'LIKE', "$slug%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function createtaxonomy()
    {
        try {
            Taxonomy::create([
                'type' => $this->type,
                'name' => $this->name,
                'slug' => $this->slug,

                
            ]);
            $this->reset([
                'type',
                'name',
                'slug',
                
                
            ]);
            $this->isModal = false;
            $paginator = Taxonomy::orderBy('id', 'desc')->paginate(20);
            $this->gettaxonomy = $paginator->items();
            $this->updatePaginationData($paginator);
            session()->flash('create_success', 'Thêm tác giả thành công');
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            $this->isModal = false;
            session()->flash('create_error', 'Thêm tác giả thất bại');
        }
    }

    public function editTaxonomy($id)
    {
        $this->dataEditTaxonomy = TaxonomyAdmin::find($id);
        if (!$this->dataEditTaxonomy) {
            session()->flash('edit_error', 'Không tìm thấy taxonomy');
            return;
        }

        $this->id = $id;
        $this->isModal = true;
        $this->type = $this->dataEditTaxonomy->type;
        $this->name = $this->dataEditTaxonomy->name;
        $this->slug = $this->dataEditTaxonomy->slug;
    }

    public function updateTaxonomy()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        try {
            TaxonomyAdmin::where('id', $this->taxonomyId)->update([
                'type' => $this->type,
                'name' => $this->name,
                'slug' => $this->slug,
            ]);
            $this->closeModal();
            $this->loadTaxonomies();
            session()->flash('update_success', 'Cập nhật taxonomy thành công');
        } catch (\Throwable $th) {
            session()->flash('update_error', 'Cập nhật taxonomy thất bại');
        }
    }

    public function deleteTaxonomy($id)
    {
        try {
            TaxonomyAdmin::destroy($id);
            $this->loadTaxonomies();
            session()->flash('delete_success', 'Xóa taxonomy thành công');
        } catch (\Throwable $th) {
            session()->flash('delete_error', 'Xóa taxonomy thất bại');
        }
    }

    public function render()
    {
        return view('livewire.taxonomy-admin');
    }
}
