<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;
use App\Models\BillModel;
use App\Models\config_admin;
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
    protected $emailAdmin;

    protected $CheckoutService;
    protected $CheckoutRepository;
    protected $CartService;
    protected $fee_shipping;

    public function __construct(
        CheckoutService $CheckoutService,
        CheckoutRepository $CheckoutRepository,
        CartService $CartService
    ) {
        $this->CheckoutService = $CheckoutService;
        $this->CheckoutRepository = $CheckoutRepository;
        $this->CartService = $CartService;
        $this->emailAdmin = config_admin::select('value')->where('key', 'email_admin')->first();
        $this->fee_shipping = config_admin::select('value')->where('key', 'fee-shipping')->first();
    }
    public function index()
    {
        $result = $this->CartService->findCartByUser(20);
        $price_sale = session()->get('price', 0);
        $id_coupon = session()->get('id_coupon');
        $fee_shipping = $this->fee_shipping->value;

        if (count($result) == 0) {
            return redirect()->route('product.index')->with('error', 'Vui lòng thêm sản phẩm vào giỏ hàng!');
        }
        return view('Client.checkout', compact(['result', 'price_sale', 'id_coupon', 'fee_shipping']));
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

    public function update(Request $request) {}

    public function delete(Request $request) {}

    public function thankyou(Request $request, $idBill)
    {
        // nếu đơn hàng chưa thanh toán thì mới hiển thị
        $resultBill = BillModel::where('id_user', Auth::user()->id)->findOrFail($idBill);

        if ($resultBill->send_email === 0) {
            Mail::to($this->emailAdmin->value)->queue(new \App\Mail\NewOrderAdminEmail($idBill));
            Mail::to($resultBill->email)->queue(new \App\Mail\sendEmailOrder($idBill));
            BillModel::find($idBill)
                ->where('id_user', Auth::user()->id)
                ->update(['send_email' => true]);
        }
        return view('Client.thankyou', compact('resultBill'));
    }

    public function show($id)
    {
        $order_details = BillModel::where('id', $id)
            ->where('id_user', '=', Auth::user()->id)
            ->first();

        if (!$order_details) {
            abort(404, 'Không tìm thấy đơn hàng');
        }

        return view('Client.qr-payment', compact('order_details'));
    }

    function checkStatus(Request $request)
    {
        $payload = $request->except(['_token']);

        if (!$payload || !isset($payload['id']) || !is_numeric($payload['id'])) {
            die('access denied');
        }

        $bill = BillModel::select(['payment_status', 'email'])
            ->where('id', $payload['id'])
            ->first();
        return $bill->payment_status;
    }
}
