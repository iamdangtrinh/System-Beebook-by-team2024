<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\CheckoutServiceInterface as CheckoutService;
use App\Repositories\Interfaces\CheckoutRepositoryInterface as CheckoutRepository;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    protected $CheckoutService;
    protected $CheckoutRepository;
    public function __construct(
        CheckoutService $CheckoutService,
        CheckoutRepository $CheckoutRepository
    ) {
        $this->CheckoutService = $CheckoutService;
        $this->CheckoutRepository = $CheckoutRepository;
    }

    public function index()
    {
        return view('Client.checkout');
    }

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
