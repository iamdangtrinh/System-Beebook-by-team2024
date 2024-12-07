<?php

namespace App\Livewire;

use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Taxonomy;
use App\Models\Favorite; // Include Favorite model
use Livewire\Component;
use Livewire\WithPagination;

class ShopLiveWire extends Component
{
    use WithPagination;

    public $title = 'Cửa hàng';
    public $sortBy = 'default';
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
        $this->hotProducts = Product::where('status', 'active')->where('hot', 1)->inRandomOrder()->limit(4)->get();

        // Xử lý tiêu đề và thực thể liên quan
        if ($type === 'category') {
            $this->relatedEntity = CategoryProduct::where('slug', $slug)->firstOrFail();
            $this->title = 'Danh mục: ' . $this->relatedEntity->name;
        } elseif ($type === 'author' || $type === 'manufacturer') {
            $this->relatedEntity = Taxonomy::where('slug', $slug)->firstOrFail();
            $this->title = $type === 'author' ? 'Tác giả: ' . $this->relatedEntity->name : $this->relatedEntity->name;
        } elseif ($type === 'hot') {
            $this->title = 'Sản phẩm nổi bật';
        } elseif ($type === 'wishlist') {
            $this->title = 'Yêu thích';
        }
    }

    protected $queryString = [
        'priceRange' => ['except' => ''],
        'languages' => ['except' => ''],
        'sortBy' => ['except' => '']
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
    public function search()
    {
        $this->resetPage(); // Reset phân trang nếu có
    }

    public function onSortChange($value)
    {
        $this->sortBy = $value;
        $this->resetPage();
    }

    public function render()
    {
        // dd($this->sortBy);
        $query = Product::query();

        // Xử lý trường hợp Category
        if ($this->type === 'category' && $this->relatedEntity) {
            $childCategories = $this->relatedEntity->children->pluck('id');
            $categoryIds = $childCategories->push($this->relatedEntity->id);
            $query->whereIn('id_category', $categoryIds);
        }
        // Xử lý trường hợp Author
        elseif ($this->type === 'author' && $this->relatedEntity) {
            $query->where('id_author', $this->relatedEntity->id);
        }
        // Xử lý trường hợp Manufacturer
        elseif ($this->type === 'manufacturer' && $this->relatedEntity) {
            $query->where('id_manufacturer', $this->relatedEntity->id);
        }
        // Xử lý trường hợp Hot
        elseif ($this->type === 'hot') {
            $query->where('hot', 1);
        }
        // Xử lý trường hợp Wishlist
        elseif ($this->type === 'wishlist') {
            $wishlist = Favorite::where('id_user', auth()->id())->pluck('id_product');
            $query->whereIn('id', $wishlist);
        }
        if ($this->type === 'wishlist') {
            // Đẩy các sản phẩm có status là inactive xuống cuối
            $query->orderByRaw('status = "inactive" ASC, quantity <= 0 ASC')
                ->orderBy('created_at', 'desc'); // Sắp xếp theo created_at sau
        } else {
            // Sắp xếp sản phẩm có quantity > 0 trước, quantity <= 0 sau
            $query->orderByRaw('quantity > 0 DESC');

            // Áp dụng điều kiện trạng thái
            $query->where('status', '!=', 'inactive');
        }


        // Lọc theo khoảng giá
        if (!empty($this->priceRange)) {
            $query->where(function ($q) {
                foreach ($this->priceRange as $range) {
                    [$min, $max] = explode('-', $range) + [null, null];

                    // Kiểm tra nếu có price_sale, sẽ sử dụng price_sale, ngược lại dùng price
                    if ($max) {
                        // Sử dụng price_sale nếu có, nếu không thì dùng price
                        $q->orWhere(function ($subQuery) use ($min, $max) {
                            $subQuery->where(function ($subQuery) use ($min, $max) {
                                $subQuery->whereBetween('price_sale', [$min, $max])
                                    ->orWhereNull('price_sale') // Trường hợp không có price_sale
                                    ->whereBetween('price', [$min, $max]);
                            });
                        });
                    } else {
                        // Xử lý trường hợp không có giá tối đa (chỉ có giá tối thiểu)
                        $q->orWhere(function ($subQuery) use ($min) {
                            $subQuery->where(function ($subQuery) use ($min) {
                                $subQuery->where('price_sale', '>=', $min)
                                    ->orWhereNull('price_sale') // Trường hợp không có price_sale
                                    ->where('price', '>=', $min);
                            });
                        });
                    }
                }
            });
        }


        // Lọc theo ngôn ngữ
        if (!empty($this->languages)) {
            $query->whereIn('language', $this->languages);
        }

        // Lọc theo tìm kiếm tên sản phẩm
        if (!empty($this->searchQuery)) {
            $query->where('name', 'like', '%' . $this->searchQuery . '%');
        }

        // Sắp xếp sản phẩm dựa trên lựa chọn của người dùng
        switch ($this->sortBy) {
            case 'newest':
                $query->orderBy('created_at', 'desc'); // Sắp xếp sản phẩm mới nhất
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc'); // Sắp xếp sản phẩm cũ nhất
                break;
            case 'price-desc': // Giá giảm dần
                $query->orderByRaw('CASE WHEN price_sale IS NOT NULL THEN price_sale ELSE price END DESC');
                break;

            case 'price-asc': // Giá tăng dần
                $query->orderByRaw('CASE WHEN price_sale IS NOT NULL THEN price_sale ELSE price END ASC');
                break;
            default:
                $query->orderBy('created_at', 'desc'); // Mặc định sắp xếp mới nhất
                break;
        }

        // Phân trang và lấy sản phẩm
        $products = $query->paginate(16);
        $this->totalProducts = $products->total();

        return view('livewire.shop', [
            'products' => $products,
            'categories' => $this->categories,
            'hotProducts' => $this->hotProducts,
            'title' => $this->title,
        ]);
    }
}
