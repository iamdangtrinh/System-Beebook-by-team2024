<?php 

use App\Http\Controllers\UserController;
use App\Http\Controllers\client\ProductController;
use App\Http\Controllers\client\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('san-pham/{slug}', [ProductController::class, 'detail'])->name('product.detail');
Route::get('cua-hang', [ProductController::class, 'index'])->name('product.index');
Route::get('san-pham-noi-bat', [ProductController::class, 'hot'])->name('product.hot');
Route::get('/danh-muc/{slug}', [ProductController::class, 'category'])->name('product.category');
Route::get('/tac-gia/{slug}', [ProductController::class, 'author'])->name('product.author');
Route::get('/nha-xuat-ban/{slug}', [ProductController::class, 'manufacturer'])->name('product.manufacturer');
Route::get('/filter-products', [ProductController::class, 'filter'])->name('products.filter');
Route::get('/yeu-thich', [WishlistController::class, 'getWishlist'])->name('wishlist.index');
Route::middleware('auth')->group(function () {
    Route::post('/wishlist/toggle/{idproduct}', [WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::post('/wishlist/remove', [WishlistController::class, 'remove'])->name('wishlist.remove');
});
