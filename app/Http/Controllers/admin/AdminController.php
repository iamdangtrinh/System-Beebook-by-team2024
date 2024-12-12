<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BillDetailModel;
use App\Models\BillModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

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

        // đếm đơn hàng trong ngày
        $orderDayCount = BillModel::select($this->seleced())->with('billDetails')
            ->with('Coupon')
            ->whereBetween('created_at', [
                Carbon::now()->startOfDay(),
                Carbon::now()->endOfDay()
            ])
            ->count();

        // đếm user được tạo trong tháng
        $countUser = User::select('id')->whereBetween('created_at', [
            Carbon::now()->startOfMonth(),
            Carbon::now()->endOfMonth()
        ])->count();

        // user mua nhiều nhất tháng
        $userBuyMost = User::select($this->selecedUserBill())->withCount(['bills' => function ($query) {
            $query->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ]);
        }])->orderBy('bills_count', 'desc')->having('bills_count', '>', 0)->limit(10)->get();

        // sản phẩm bán chạy nhất tháng
        // $topSellingProducts = BillDetailModel::select(
        //     'products.id as product_id',
        //     'products.name as product_name',
        //     'products.image_cover as product_image',
        //     'products.quantity as product_stock',
        //     DB::raw('SUM(bill_detail.quantity) as total_quantity_sold')
        // )
        //     ->join('products', 'bill_detail.id_product', '=', 'products.id')
        //     ->join('bills', 'bill_detail.id_bill', '=', 'bills.id')
        //     ->whereBetween('bills.created_at', [
        //         Carbon::now()->startOfMonth(),
        //         Carbon::now()->endOfMonth()
        //     ])
        //     ->where('bills.status', 'success')
        //     ->groupBy('products.id', 'products.name')
        //     ->orderByDesc('total_quantity_sold')
        //     ->limit(10)
        //     ->get();

        $amount_month = 0;
        foreach ($order as $key => $amount) {
            $amount_month += $amount->total_amount;
        }

        $countOrder = count($order);


        $orderYear = BillModel::selectRaw(
            'SUM(total_amount) as total_amount,
                    MONTH(created_at) as month, 
                    SUM(CASE WHEN status = "success" THEN 1 ELSE 0 END) as success_count,
                    SUM(CASE WHEN status = "cancel" THEN 1 ELSE 0 END) as cancel_count'
        )
            ->whereBetween('created_at', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfMonth()
            ])
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get();

        return view('admin.index', compact(
            'countOrder',
            'amount_month',
            'countUser',
            'orderDayCount',
            'userBuyMost',
            // 'topSellingProducts',
            'orderYear'
        ));
    }

    public function getTopSellingProducts(Request $request)
    {
        // Get filter inputs
        $timeRange = $request->input('time_range', 1); // Default to 1 month
        $limit = $request->input('limit', 3);         // Default to 3 products

        // Calculate date range
        $startDate = Carbon::now()->subMonths($timeRange)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        // Fetch top-selling products
        $topSellingProducts = BillDetailModel::select(
            'products.id as product_id',
            'products.name as product_name',
            'products.image_cover as product_image',
            DB::raw('SUM(bill_detail.quantity) as total_quantity_sold')
        )
            ->join('products', 'bill_detail.id_product', '=', 'products.id')
            ->join('bills', 'bill_detail.id_bill', '=', 'bills.id')
            ->whereBetween('bills.created_at', [$startDate, $endDate])
            ->where('bills.status', 'success')
            ->groupBy('products.id', 'products.name', 'products.image_cover')
            ->orderByDesc('total_quantity_sold')
            ->limit($limit)
            ->get();

        return response()->json($topSellingProducts);
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
