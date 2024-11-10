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
use Illuminate\Support\Facades\Mail;

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
        if(count($result) == 0) {
            return redirect()->route('product.index')->with('error', 'Vui lòng thêm sản phẩm vào giỏ hàng!');
        }
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

    public function thankyou(Request $request, $idBill)
    {
        // nếu đơn hàng chưa thanh toán thì mới hiển thị
        $resultBill = BillModel::findOrFail($idBill);
        Mail::to($resultBill->email)->send(new \App\Mail\sendEmailOrder($idBill));
        if ($resultBill->payment_status === 'PAID') {
            return redirect()->route('your-order-detail.index', ['id' => $idBill]);
        }
        Mail::to($resultBill->email)->send(new \App\Mail\sendEmailOrder($resultBill->id));
        return view('Client.thankyou', compact('resultBill'));
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

    // hàm tìm payment status của đơn hàng
    // gửi email cho đơn hàng
    // chuyển về trang thank you
    function checkStatus(Request $request)
    {
        $payload = $request->except(['_token']);

        if (!$payload || !isset($payload['id']) || !is_numeric($payload['id'])) {
            die('access denied');
        }

        $bill = BillModel::select(['payment_status', 'email'])
            ->where('id', $payload['id'])
            // ->where('payment_status', 'PAID')
            ->first();
        return $bill->payment_status;
    }
}
