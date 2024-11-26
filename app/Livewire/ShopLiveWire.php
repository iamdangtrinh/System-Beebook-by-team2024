<?php

namespace App\Livewire;

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\TaxonomyModel;
use App\Models\Favorite; // Include Favorite model
use Livewire\Component;
use Livewire\WithPagination;

class ShopLiveWire extends Component
{
    use WithPagination;

    public $title = 'Cửa hàng';
    public $totalProducts;
    public $categories;
    public $hotProducts;
    public $priceRange = [];
    public $languages = [];
    public $searchQuery = '';
    public $type; // Loại dữ liệu (hot, category, author, manufacturer, wishlist)
    public $slug; // Dùng cho slug của danh mục, tác giả, hoặc nhà sản xuất
    public $relatedEntity; // Thực thể liên quan (CategoryProduct hoặc Taxonomy)

    public function mount($type = 'index', $slug = null)
    {
        $this->type = $type;
        $this->slug = $slug;

        // Tải danh mục
        $this->categories = CategoryProduct::whereNull('parent_id')
            ->where('status', 'active')
            ->with(['children' => function ($query) {
                $query->where('status', 'active');
            }])->get();

        // Tải sản phẩm nổi bật
        $this->hotProducts = Product::where('hot', 1)->inRandomOrder()->limit(4)->get();

        // Xử lý tiêu đề và thực thể liên quan
        if ($type === 'category') {
            $this->relatedEntity = CategoryProduct::where('slug', $slug)->firstOrFail();
            $this->title = 'Danh mục: ' . $this->relatedEntity->name;
        } elseif ($type === 'author' || $type === 'manufacturer') {
            $this->relatedEntity = TaxonomyModel::where('slug', $slug)->firstOrFail();
            $this->title = $type === 'author' ? 'Tác giả: ' . $this->relatedEntity->name : $this->relatedEntity->name;
        } elseif ($type === 'hot') {
            $this->title = 'Sản phẩm nổi bật';
        } elseif ($type === 'wishlist') {
            $this->title = 'Yêu thích';
        }
    }

    protected $queryString = [
        'priceRange' => ['except' => ''],
        'languages' => ['except' => '']
    ];

    public function applyPriceFilter($range)
    {
        if (in_array($range, $this->priceRange)) {
            $this->priceRange = array_diff($this->priceRange, [$range]);
        } else {
            $this->priceRange[] = $range;
        }

        $this->resetPage();
    }

    public function toggleLanguage($language)
    {
        if (in_array($language, $this->languages)) {
            $this->languages = array_diff($this->languages, [$language]);
        } else {
            $this->languages[] = $language;
        }

        $this->resetPage();
    }
    public function updatedSearchQuery()
    {
        $this->resetPage(); // Reset pagination when search query changes
    }
    public function render()
    {
        $query = Product::query()->where('status', 'active');

        if ($this->type === 'category' && $this->relatedEntity) {
            $childCategories = $this->relatedEntity->children->pluck('id');
            $categoryIds = $childCategories->push($this->relatedEntity->id);
            $query->whereIn('id_category', $categoryIds);
        } elseif ($this->type === 'author' && $this->relatedEntity) {
            $query->where('id_author', $this->relatedEntity->id);
        } elseif ($this->type === 'manufacturer' && $this->relatedEntity) {
            $query->where('id_manufacturer', $this->relatedEntity->id);
        } elseif ($this->type === 'hot') {
            $query->where('hot', 1);
        } elseif ($this->type === 'wishlist') {
            if (!auth()->check()) {
                session()->flash('error', 'Vui lòng đăng nhập để xem và thêm sản phẩm yêu thích!');
                return redirect('/sign-in');
            }

            $wishlist = Favorite::where('id_user', auth()->id())->pluck('id_product');
            $query->whereIn('id', $wishlist);
        }

        if (!empty($this->priceRange)) {
            $query->where(function ($q) {
                foreach ($this->priceRange as $range) {
                    [$min, $max] = explode('-', $range) + [null, null];
                    if ($max) {
                        $q->orWhereBetween('price', [$min, $max]);
                    } else {
                        $q->orWhere('price', '>=', $min);
                    }
                }
            });
        }

        if (!empty($this->languages)) {
            $query->whereIn('language', $this->languages);
        }
        if (!empty($this->searchQuery)) {
            $query->where('name', 'like', '%' . $this->searchQuery . '%');
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(12);
        $this->totalProducts = $products->total();
        return view('livewire.shop', [
            'products' => $products,
            'categories' => $this->categories,
            'hotProducts' => $this->hotProducts,
            'title' => $this->title,
        ]);
    }
}
