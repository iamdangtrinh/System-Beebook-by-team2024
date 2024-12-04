<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BillModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    private function seleced()
    {
        return [
            'id',
            'id_user',
            'id_coupon',
            'total_amount',
            'status',
            'created_at',
            'updated_at'
        ];
    }

    public function index()
    {

        // đơn hàng
        // tài khoản
        // thu nhập trên tháng
        // khách hàng mua nhiều
        // top sản phẩm bán chaỵ

        // doanh thu của tháng
        $order = BillModel::select($this->seleced())->with('billDetails')
            ->with('Coupon')
            ->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
            ->get();

        $countUser = User::select('id')->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();

        $amount_month = 0;
        foreach ($order as $key => $amount) {
            $amount_month += $amount->total_amount;
        }

        $countOrder = count($order);

        return view('admin.index', compact([
            'countOrder',
            'amount_month',
            'countUser',
        ]));
    }

    public function show404()
    {
        return view('admin.404');
    }
    public function show500()
    {
        return view('admin.500');
    }

    public function blogs()
    {
        return view('admin.blogs');
    }
    public function article()
    {
        return view('admin.article');
    }

    public function dashboard_3()
    {
        return view('admin.dashboard_3');
    }
}
