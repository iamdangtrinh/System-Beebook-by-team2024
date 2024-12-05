<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BillDetailModel;
use App\Models\BillModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    private function selecedUserBill()
    {
        return [
            'name',
            'email',
            'phone',
            'status',
            'address',
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

        $orderDayCount = BillModel::select($this->seleced())->with('billDetails')
            ->with('Coupon')
            ->whereBetween('created_at', [
                Carbon::now()->startOfDay(),
                Carbon::now()->endOfDay()
            ])
            ->count();

        $countUser = User::select('id')->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();

        // query user buy most of month
        $userBuyMost = User::select($this->selecedUserBill())->withCount(['bills' => function ($query) {
            $query->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ]);
        }])->orderBy('bills_count', 'desc')->having('bills_count', '>', 0)->limit(10)->get();

        // top product sell on month
        $topSellingProducts = BillDetailModel::select(
            'products.id as product_id',
            'products.name as product_name',
            DB::raw('SUM(bill_detail.quantity) as total_quantity_sold')
        )
            ->join('products', 'bill_detail.id_product', '=', 'products.id')
            ->join('bills', 'bill_detail.id_bill', '=', 'bills.id')
            ->whereBetween('bills.created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_quantity_sold')
            ->limit(10) // Giới hạn 10 sản phẩm bán chạy nhất
            ->get();

        $amount_month = 0;
        foreach ($order as $key => $amount) {
            $amount_month += $amount->total_amount;
        }

        $countOrder = count($order);

        return view('admin.index', compact(
            'countOrder',
            'amount_month',
            'countUser',
            'orderDayCount',
            'userBuyMost',
            'topSellingProducts'
        ));
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
