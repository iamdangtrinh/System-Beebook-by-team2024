<?php

namespace App\Services;

use App\Models\productModel;
use App\Services\Interfaces\CartServiceInterface;
use App\Repositories\Interfaces\CartRepositoryInterface as CartRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserService
 * @package App\Services
 */
class CartService implements CartServiceInterface
{
    protected $CartRepository;
    private $isAuthenticated;
    public function __construct(CartRepository $CartRepository)
    {
        $this->CartRepository = $CartRepository;
        $this->isAuthenticated = Auth::user();
    }

    private function paginateSelect()
    {
        return [
            'id',
            'id_user',
            'id_product',
            'price',
            'quantity',
        ];
    }

    public function findCartByUser($perPage = 20)
    {
        if ($this->isAuthenticated) {
            $cart = $this->CartRepository->findCart(
                $this->paginateSelect(),
                1,
                $perPage
            );
        } else {
            // Lấy giỏ hàng từ session
            $carts = session()->get('cart', []);
            // Khởi tạo mảng chứa các ID sản phẩm từ giỏ hàng
            $proIdArr = array_column($carts, 'product_id');
            // Truy vấn sản phẩm từ cơ sở dữ liệu dựa trên các product_id
            $products = ProductModel::whereIn('id', $proIdArr)->get();
            // Tạo một mảng để lưu kết hợp dữ liệu từ giỏ hàng và sản phẩm
            $cart = [];
            foreach ($products as $product) {
                $productId = $product->id;
                // Lấy thông tin từ session giỏ hàng dựa trên product_id
                $sessionCartItem = $carts[$productId];
                // Kết hợp dữ liệu của sản phẩm và giỏ hàng (giá và số lượng)
                $cart[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image_cover' => $product->image_cover,
                    'slug' => $product->slug,
                    'price_product' => $product->price, // Giá từ giỏ hàng
                    'quantity_product' => $product->quantity, // Giá từ giỏ hàng
                    'quantity' => $sessionCartItem['quantity'], // Số lượng từ giỏ hàng
                    'price' => $sessionCartItem['product_price'], // Giá từ giỏ hàng
                ];
            }
        }

        return $cart;
    }

    // thêm sản phẩm vào giỏ hàng
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token']);
            if ($this->isAuthenticated) {
                if (!$payload['id_product']) {
                    abort(404);
                }
                $response = $this->CartRepository->addToCart($payload);
            } else {
                // kiểm tra giỏ hàng có tồn tại hay không
                $cart = $request->session()->get('cart', []);
                $productId = $payload['id_product'];
                $quantityToAdd = $payload['quantity'];
                $productPrice = $payload['price'];

                // Cập nhật số lượng
                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] += $quantityToAdd; // Cộng thêm số lượng mới
                } else {
                    // Nếu sản phẩm chưa có, thêm mới vào giỏ hàng
                    $cart[$productId] = [
                        'product_id' => $productId,
                        'quantity' => $quantityToAdd,
                        'product_price' => $productPrice,
                    ];
                }

                session()->put('cart', $cart);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            echo $exception->getMessage();
            return false;
        }
    }

    public function update($id, $request)
    {
        //     DB::beginTransaction();
        //     try {
        //         $payload = $request->except(['_token']);
        //         $response = $this->CartRepository->update($id, $payload);
        //         DB::commit();
        //         return true;
        //     } catch (\Exception $exception) {
        //         DB::rollBack();
        //         echo $exception->getMessage();
        //         return false;
        //     }
    }

    // cập nhật số lượng sản phẩm trong cart
    public function updateCart(Request $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token']);
            if ($this->isAuthenticated) {
                $payload['id_user'] = '1';
                $response = $this->CartRepository->updateQuantityCart($payload);
            } else {
                // cập nhật giỏ hàng khi chưa có đăng nhập
                $cart = $request->session()->get('cart', []);
                $productId = $payload['id_product'];
                $quantityToAdd = $payload['quantity'];

                // Cập nhật số lượng
                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] = $quantityToAdd; // Cập nhật số lượng sản phẩm
                }

                session()->put('cart', $cart);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            echo $exception->getMessage();
            return false;
        }
    }

    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token']);
            $id_product = $payload['id_product'];
            // xóa khi có đăng nhập
            if ($this->isAuthenticated) {
                $response = $this->CartRepository->delete($payload['id_cart']);
            } else {
                $cart = $request->session()->get('cart', []);
                // Xóa sản phẩm khỏi giỏ hàng
                if (isset($cart[$id_product])) {
                    unset($cart[$id_product]);
                }
                $request->session()->put('cart', $cart);
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            echo $exception->getMessage();
            return false;
        }
    }
}
