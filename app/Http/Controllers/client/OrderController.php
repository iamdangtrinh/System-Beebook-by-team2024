<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\BillModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function update(Request $request)
    {
        $payload = $request->except(['_token']);
        BillModel::find($payload['id'])
            ->where('id_user', Auth::user()->id)
            ->update(['status' => $payload['status']])
        ;
    }
    public function cancel(string $id)
    {
        $result = BillModel::where('id', $id)
            ->where('id_user', Auth::user()->id)
            ->update(['status' => 'cancel']);
        if ($result) {
            return redirect()->route('your-order.index')->with('success', 'Hủy đơn hàng thành công!');
        }
        return redirect()->route('your-order.index')->with('success', 'Hủy đơn hàng thành công!');
    }
}
