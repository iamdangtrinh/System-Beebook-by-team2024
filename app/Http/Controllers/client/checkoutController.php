<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\BillModel;
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
    public function store(CheckoutRequest $request)
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

    public function update(Request $request) {}

    public function delete(Request $request) {}

    public function viewcarttocart()
    {
        return view('addtocart');
    }

    public function thankyou()
    {
        // lấy url hiện tại
        $path = $_SERVER['REQUEST_URI'];
        // cắt chuỗi
        $parts = explode('thank-you/', $path);
        $code = $parts[1] ?? null;
        $idBill = ($code);
        $resultBill = BillModel::where('id', $idBill)->firstOrFail();

        return view('Client.thankyou', compact(['resultBill']));
    }

    public function show($id)
    {
        // Lấy thông tin đơn hàng
        $order_details = BillModel::find($id);
        if (!$order_details) {
            abort(404, 'Không tìm thấy đơn hàng');
        }

        return view('Client.qr-payment', compact('order_details'));
    }
}
