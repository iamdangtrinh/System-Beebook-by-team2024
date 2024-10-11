<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\CheckoutServiceInterface as CheckoutService;
use App\Repositories\Interfaces\CheckoutRepositoryInterface as CheckoutRepository;
use App\Services\Interfaces\CartServiceInterface as CartService;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CheckoutController extends Controller
{
    protected $CheckoutService;
    protected $CheckoutRepository;
    protected $CartService;
    public function __construct(
        CheckoutService $CheckoutService,
        CheckoutRepository $CheckoutRepository,
        CartService $CartService
    ) {
        $this->CheckoutService = $CheckoutService;
        $this->CheckoutRepository = $CheckoutRepository;
        $this->CartService = $CartService;
    }

    public function index()
    {
        // if (Auth::user()) {
        $result = $this->CartService->findCartByUser(20);
        return view('Client.checkout', compact(['result']));
        // } else {
        //     return redirect('/sign-in')->with('error', 'Vui lòng đăng nhập để thực hiện!');
        // }
    }

    public function cartToCheckout(Request $request) {}

    // tạo view cart
    public function create() {}

    // mua hàng
    public function store(Request $request)
    {
        $productId = isset($_COOKIE['productChecked']) ? base64_decode($_COOKIE['productChecked']) : '';
        $productIds = array_filter(explode(',', $productId));
        $products = Product::whereIn('id', $productIds)->get();

        dd($products);

        $result = $this->CheckoutService->create($request);
        return $result;
        // if (Auth::user()) {
        // } else {
        //     return redirect('/sign-in')->with('error', 'Vui lòng đăng nhập để thực hiện!');
        // }
    }

    // tạo view hiển thị giỏ hàng
    public function edit($id)
    {
        $cart = $this->CheckoutRepository->findById($id);
        return response()->json($cart);
    }

    public function update(Request $request)
    {
        $result = $this->CheckoutService->updateCart($request);

        if ($result) {
            return "Cập nhật số lượng sản phẩm thành công!";
        } else {
            return "Cập nhật số lượng sản phẩm thất bại!";
        }
    }

    public function delete(Request $request)
    {
        $result = $this->CheckoutService->destroy($request);
        if ($result) {
            return "Xóa sản phẩm thành công!";
        } else {
            return "Xóa sản phẩm thất bại!";
        }
    }

    public function deleteSoft($id)
    {
        $seo = config('apps.cart.delete');
        $cart = $this->CheckoutRepository->delete($id);
    }

    public function destroy($id)
    {
        if ($this->CheckoutService->destroy($id)) {
            return redirect()->route('cart.index')->with('success', 'Delete cart success');
        }
        return redirect()->route('cart.index')->with('error', 'Delete cart error, please again');
    }

    public function viewcarttocart()
    {
        return view('addtocart');
    }
}
