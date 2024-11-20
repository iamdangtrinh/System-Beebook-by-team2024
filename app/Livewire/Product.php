<?php

namespace App\Livewire;

use App\Models\BillModel;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ProductsV2 extends Component
{
    use WithPagination, WithoutUrlPagination;
    public function render()
    {
        $title = 'Cửa hàng';
        $routeName = 'product.index';
        $products = Product::orderBy('created_at', 'desc')->paginate(12, ['*']);
        $categories = CategoryProduct::whereNull('parent_id')
            ->where('status', 'active')
            ->with(['children' => function ($query) {
                $query->where('status', 'active');
            }])->get();
        $totalProducts = $products->count();
        $hotProducts = Product::where('hot', 1)->inRandomOrder()->limit(4)->get();
        return view('livewire.shop', compact([
            'products',
            'routeName',
            'totalProducts',
            'hotProducts',
            'categories',
            'title'
        ]));
    }
}
