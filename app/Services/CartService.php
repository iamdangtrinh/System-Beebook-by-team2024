<?php

namespace App\Services;

use App\Models\Product;
use App\Services\Interfaces\CartServiceInterface;
use App\Repositories\Interfaces\CartRepositoryInterface as CartRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserService
 * @package App\Services
 */
class CartService implements CartServiceInterface
{
    protected $CartRepository;
    public function __construct(CartRepository $CartRepository)
    {
        $this->CartRepository = $CartRepository;
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
        $cart = [];
        if (Auth::check()) {
            $cart = $this->CartRepository->findCart($this->paginateSelect(), Auth::user()->id, $perPage);
        } else {
            $carts = session()->get('cart', []);
            $proIdArr = array_column($carts, 'product_id');
            $products = Product::whereIn('id', $proIdArr)->where('status', 'active')->get() ?? [];
            $cart = [];
            foreach ($products as $product) {
                $productId = $product->id;
                $sessionCartItem = $carts[$productId];
                $cart[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image_cover' => $product->image_cover,
                    'slug' => $product->slug,
                    'price_product' => $product->price,
                    'quantity_product' => $product->quantity,
                    'quantity' => $sessionCartItem['quantity'],
                    'price' => $sessionCartItem['product_price'],
                ];
            }

            session()->put('cart', array_filter($carts, function ($item) use ($products) {
                return $products->contains('id', $item['product_id']);
            }));
        }

        return $cart;
    }

    // thêm sản phẩm vào giỏ hàng
    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token']);
            if (Auth::check()) {
                $payload['id_user'] = Auth::user()->id;
                $response = $this->CartRepository->addToCart($payload);
            } else {
                $product = Product::select(['quantity', 'price', 'price_sale'])->find($payload['id_product']);

                $price = $product->price_sale !== null ? $product->price_sale : $product->price;

                // Kiểm tra giỏ hàng có tồn tại hay không
                $cart = $request->session()->get('cart', []);
                $productId = $payload['id_product'];
                $quantityToAdd = $payload['quantity'];
                $productPrice = $price;

                // Cập nhật số lượng
                if (isset($cart[$productId])) {
                    $cart[$productId]['quantity'] += $quantityToAdd; // Cộng thêm số lượng mới

                    // Nếu số lượng sản phẩm trong giỏ hàng lớn hơn hoặc bằng số lượng tối đa
                    if ($cart[$productId]['quantity'] > $product->quantity) {
                        // Cập nhật số lượng sản phẩm trong giỏ hàng về số lượng tối đa
                        $cart[$productId]['quantity'] = $product->quantity;

                        $response = [
                            'status' => 'error',
                            'data' => "Rất tiếc, bạn chỉ có thể mua tối đa " . $product->quantity . " sản phẩm"
                        ];
                    } else {
                        // Nếu số lượng sản phẩm trong giỏ hàng nhỏ hơn số lượng tối đa, bạn có thể cập nhật
                        $response = [
                            'status' => 'success',
                            'data' => "Cập nhật giỏ hàng thành công."
                        ];
                    }
                } else {
                    // Nếu sản phẩm chưa có, thêm mới vào giỏ hàng
                    $cart[$productId] = [
                        'product_id' => $productId,
                        'quantity' => $quantityToAdd,
                        'product_price' => $productPrice,
                    ];

                    $response = [
                        'status' => 'success',
                        'data' => "Thêm sản phẩm vào giỏ hàng thành công."
                    ];
                }

                // Lưu lại giỏ hàng vào session
                $request->session()->put('cart', $cart);
            }
            DB::commit();
            return redirect('cart')->with($response['status'], $response['data']);
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
            if (Auth::check()) {
                $payload['id_user'] = Auth::user()->id;
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
            if (Auth::check()) {
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

    public function destroyAll()
    {
        DB::beginTransaction();
        try {
            $response = $this->CartRepository->deleteAll();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            echo $exception->getMessage();
            return false;
        }
    }
}
