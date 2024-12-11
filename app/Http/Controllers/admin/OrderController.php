<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BillModel;
use App\Models\couponModel;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // hiển thị admin order

    protected function selected()
    {
        return [
            "id",
            "id_user",
            "status",
            "total_amount",
            "payment_method",
            "payment_status",
            "phone",
            "name",
            "note",
            "created_at",
            "updated_at",
        ];
    }

    public function index(Request $request)
    {
        $payload = $request->except(['_token']);
        $query = BillModel::select($this->selected())->orderBy('id', 'desc');
        if (!empty($payload['order_id'])) {
            $query->where('id', $payload['order_id']);
        }

        if (!empty($payload['status'])) {
            $query->where('status', $payload['status']);
        }
        if (!empty($payload['customer'])) {
            $query->where('id_user', '=', $payload['customer']);
        }

        if (!empty($payload['amount'])) {
            $query->where('total_amount', $payload['amount']);
        }
        $results = $query->paginate(20)->withQueryString();
        $users = User::select(['id', 'name'])->get();
        return view('admin.order.index', compact(['results', 'users']));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $payload = $request->except(['_token']);

        BillModel::where('id', $payload['id'])
            ->update([
                'status' => $payload['status'],
                'note_admin' => $payload['note_admin']
            ]);

        if ($payload['status'] === 'cancel') {
            try {
                $order = BillModel::where('id', $payload['id'])
                    ->where('id_user', Auth::user()->id)
                    ->with('billDetails')
                    ->with('Coupon')
                    ->firstOrFail();

                foreach ($order->billDetails as $key => $value) {
                    $product = Product::select(['id', 'quantity'])->find($value->id);
                    if ($product) {
                        Product::where('id', $value->id)->update(['quantity' => $product->quantity += $value->quantity]);
                    }
                }

                if ($order->Coupon) {
                    $coupon = $order->Coupon;
                    couponModel::where('id', $coupon->id)->increment('quantity');
                }
                $order->update(['status' => 'cancel']);
            } catch (\Exception $e) {
                return redirect()->route('admin.order.detail', ['id' => $payload['id']])->with('error', 'Không thể hủy đơn hàng, vui lòng thử lại.!');
            }
        }


        return redirect()->route('admin.order.detail', ['id' => $payload['id']])->with('success', 'Cập nhật đơn hàng thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $orderDetails = BillModel::where('id', $id)
            ->with('billDetails')
            ->with('billUser')
            ->with('Coupon')
            ->first();

        return view('admin.order.store', compact(['orderDetails']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
