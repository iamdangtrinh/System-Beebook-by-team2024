<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\cartRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\CartServiceInterface as CartService;
use App\Repositories\Interfaces\CartRepositoryInterface as CartRepository;
use Illuminate\Support\Facades\Session;

class cartController extends Controller
{
    protected $CartService;
    protected $CartRepository;
    public function __construct(
        CartService $CartService,
        CartRepository $CartRepository
    ) {
        $this->CartService = $CartService;
        $this->CartRepository = $CartRepository;
    }

    public function index()
    {
        $result = $this->CartService->findCartByUser(20);
        return view('Client.cart', compact([
            'result'
        ]));
    }

    // tạo view cart
    public function create() {}

    //   tạo giỏ hàng nếu có đăng nhạp
    public function store(Request $request)
    {
        // nếu có đăng nhập
        $result = $this->CartService->create($request);
        // nếu không có đăng nhập
        return $result;
    }

    // tạo view hiển thị giỏ hàng
    public function edit($id)
    {
        $cart = $this->CartRepository->findById($id);
        return response()->json($cart);
    }

    public function update(cartRequest $request)
    {
        $result = $this->CartService->updateCart($request);

        if ($result) {
            return "Cập nhật số lượng sản phẩm thành công!";
        } else {
            return "Cập nhật số lượng sản phẩm thất bại!";
        }
    }

    public function delete(Request $request)
    {
        $result = $this->CartService->destroy($request);
        if ($result) {
            return "Xóa sản phẩm thành công!";
        } else {
            return "Xóa sản phẩm thất bại!";
        }
    }

    public function deleteSoft($id)
    {
        $seo = config('apps.cart.delete');
        $cart = $this->CartRepository->delete($id);
    }

    public function destroy($id)
    {
        if ($this->CartService->destroy($id)) {
            return redirect()->route('cart.index')->with('success', 'Delete cart success');
        }
        return redirect()->route('cart.index')->with('error', 'Delete cart error, please again');
    }

    public function viewcarttocart()
    {
        return view('addtocart');
    }
}
