<?php

namespace App\Livewire;

use App\Models\CategoryProduct;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ShopLiveWire extends Component
{
    use WithPagination;

    public $title = 'Cửa hàng';
    public $routeName = 'product.index';
    public $totalProducts;
    public $categories;
    public $hotProducts;
    public $priceRange = [];
    public $languages = [];
    // Hàm mount để load dữ liệu ban đầu
    public function mount()
    {
        // Load dữ liệu các danh mục và sản phẩm nổi bật
        $this->categories = CategoryProduct::whereNull('parent_id')
            ->where('status', 'active')
            ->with(['children' => function ($query) {
                $query->where('status', 'active');
            }])->get();

        $this->hotProducts = Product::where('hot', 1)->inRandomOrder()->limit(4)->get();
    }

    // Hàm xử lý khi thay đổi giá trị priceRange
    public function updatedPriceRange()
    {
        $this->resetPage(); // Reset phân trang khi thay đổi filter
    }

    // lưu và url của product
    protected $queryString = [
        'priceRange' => ['except' => ''],
        'languages' => ['except' => '']
    ];

    // Hàm áp dụng bộ lọc giá
    public function applyPriceFilter($range)
    {
        // Kiểm tra xem khoảng giá đã được chọn hay chưa
        if (in_array($range, $this->priceRange)) {
            // Nếu đã chọn, bỏ chọn khoảng giá
            $this->priceRange = array_diff($this->priceRange, [$range]);
        } else {
            // Nếu chưa chọn, thêm khoảng giá vào mảng
            $this->priceRange[] = $range;
        }

        $this->resetPage(); // Reset phân trang khi thay đổi filter
    }

    public function toggleLanguage($language)
    {
        if (in_array($language, $this->languages)) {
            // Nếu ngôn ngữ đã được chọn, bỏ chọn nó
            $this->languages = array_diff($this->languages, [$language]);
        } else {
            // Nếu ngôn ngữ chưa được chọn, thêm vào mảng
            $this->languages[] = $language;
        }

        $this->resetPage(); // Reset phân trang khi thay đổi bộ lọc
    }

    // Hàm render để trả về view
    public function render()
    {
        $query = Product::query();

        // Lọc theo khoảng giá nếu có
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

         // Lọc theo ngôn ngữ nếu có
         if (!empty($this->languages)) {
            $query->whereIn('language', $this->languages);
        }

        // Lấy sản phẩm đã lọc và phân trang
        $products = $query->orderBy('created_at', 'desc')->paginate(12);

        // Cập nhật tổng số sản phẩm
        $this->totalProducts = Product::count();

        return view('livewire.shop', [
            'products' => $products,
            'routeName' => $this->routeName,
            'totalProducts' => $this->totalProducts,
            'hotProducts' => $this->hotProducts,
            'categories' => $this->categories,
            'title' => $this->title,
        ]);
    }
}
