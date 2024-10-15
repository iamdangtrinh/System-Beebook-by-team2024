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
        $result = $this->CartService->findCartByUser(20);
        return view('Client.checkout', compact(['result']));
    }

    public function cartToCheckout(Request $request) {}

    // tạo view cart
    public function create() {}

    // mua hàng
    public function store(Request $request)
    {
        $result = $this->CheckoutService->create($request);
        return $result;
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

    public function viewcarttocart()
    {
        return view('addtocart');
    }
}
