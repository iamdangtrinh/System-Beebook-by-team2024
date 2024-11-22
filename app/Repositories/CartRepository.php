<?php

namespace App\Repositories;

use App\Models\cartModel;
use App\Models\Product;
use App\Repositories\Interfaces\CartRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class cartModelService
 * @package App\Services
 */
class CartRepository extends BaseRepository implements CartRepositoryInterface
{
    protected $model;
    public function __construct(cartModel $model)
    {
        $this->model = $model;
    }
    public function getAllPaginate()
    {
        return $carts = $this->model::all();
    }

    // query cart
    public function findCart(array $column = ['*'], int $id_user = 0, $perpage = 20)
    {
        $query = $this->model
            ->select($column)
            ->where('id_user', '=', $id_user)
            ->with(['cartProduct' => function ($query) {
                $query->where('status', 'active');
            }])
            ->paginate($perpage);

        $query->each(function ($cartItem) {
            if ($cartItem->cartProduct->isEmpty()) {
                $cartItem->delete();
            }
        });
        return $query;
    }

    // cập nhật số lượng sản phẩm
    public function updateQuantityCart(array $payload = [])
    {
        $query = $this->model
            ->where('id_user', '=', $payload['id_user'])
            ->where('id_product', '=', $payload['id_product'])
            ->update(['quantity' => (int)$payload['quantity']]);
        return $query;
    }

    public function addToCart($payload)
    {
        $userExist = $this->model
            ->where('id_user', '=', $payload['id_user'])
            ->where('id_product', '=', $payload['id_product'])
            ->first();

        $product = Product::select(['quantity', 'price', 'price_sale'])->find($payload['id_product']);
        $price = $product->price_sale !== null ? $product->price_sale : $product->price;
        $payload['price'] = $price;
        if ($userExist) {

            if ($userExist->quantity >= $product->quantity) {
                $userExist->quantity = $product->quantity;
                $response = [
                    'status' => 'error',
                    'data' => "Rất tiếc, bạn chỉ có thể mua tối đa " . $product->quantity . " sản phẩm"
                ];
            } else {
                $userExist->quantity += $payload['quantity'];
                $response = [
                    'status' => 'success',
                    'data' => "Cập nhật giỏ hàng thành công"
                ];
            }
            $userExist->save();
            return $response;
        } else {
            $this->model->create($payload);

            return $response = [
                'status' => 'success',
                'data' => "Thêm sản phẩm vào giỏ hàng thành công"
            ];
        }
    }

    public function deleteAll()
    {
        $query = $this->model->where('id_user', Auth::user()->id)->delete();
        return $query;
    }
}
