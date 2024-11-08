<?php 

use App\Http\Controllers\UserController;
use App\Http\Controllers\client\ProductController;
use App\Http\Controllers\client\WishlistController;
use App\Http\Controllers\admin\ProductController as AdminProductController;
use Illuminate\Support\Facades\Route;

Route::get('san-pham/{slug}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('cua-hang/{page?}', [ProductController::class, 'index'])->name('product.index')->where('page', '[0-9]+');;
Route::get('san-pham-noi-bat/{page?}', [ProductController::class, 'hot'])->name('product.hot')->where('page', '[0-9]+');;
Route::get('/danh-muc/{slug}/{page?}', [ProductController::class, 'category'])->name('product.category')->where('page', '[0-9]+');;
Route::get('/tac-gia/{slug}/{page?}', [ProductController::class, 'author'])->name('product.author')->where('page', '[0-9]+');;
Route::get('/nha-xuat-ban/{slug}/{page?}', [ProductController::class, 'manufacturer'])->name('product.manufacturer')->where('page', '[0-9]+');;
Route::get('/filter-products', [ProductController::class, 'filter'])->name('products.filter');
Route::get('/yeu-thich/{page?}', [WishlistController::class, 'getWishlist'])->name('wishlist.index')->where('page', '[0-9]+');;
Route::middleware('auth')->group(function () {
    Route::post('/wishlist/toggle/{idproduct}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
});

Route::prefix('admin')->group(function () {
    Route::get('/product', [AdminProductController::class, 'index'])->name('adminproduct.index');
});
