<?php

namespace App\Providers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    protected $serviceBindings = [
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',
        
        'App\Services\Interfaces\CartServiceInterface' => 'App\Services\CartService',
        'App\Repositories\Interfaces\CartRepositoryInterface' => 'App\Repositories\CartRepository',
        
        'App\Services\Interfaces\CouponServiceInterface' => 'App\Services\CouponService',
        'App\Repositories\Interfaces\CouponRepositoryInterface' => 'App\Repositories\CouponRepository',
        
        'App\Services\Interfaces\CheckoutServiceInterface' => 'App\Services\CheckoutService',
        'App\Repositories\Interfaces\CheckoutRepositoryInterface' => 'App\Repositories\CheckoutRepository',
        
        'App\Services\Interfaces\BillDetailServiceInterface' => 'App\Services\BillDetailService',
        'App\Repositories\Interfaces\BillDetailRepositoryInterface' => 'App\Repositories\BillDetailRepository',
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        foreach($this->serviceBindings as $key => $val) {
            $this->app->bind($key,$val);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
    }
}
