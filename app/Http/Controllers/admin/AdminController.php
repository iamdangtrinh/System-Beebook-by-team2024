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
        // $order = BillModel::select($this->seleced())->with('billDetails')
        //     ->with('Coupon')
        //     ->where('status', 'success')
        //     ->whereBetween('created_at', [
        //         Carbon::now()->startOfMonth(),
        //         Carbon::now()->endOfMonth()
        //     ])
        //     ->get();

        // // đếm đơn hàng trong ngày
        // $orderDayCount = BillModel::select($this->seleced())->with('billDetails')
        //     ->with('Coupon')
        //     ->whereBetween('created_at', [
        //         Carbon::now()->startOfDay(),
        //         Carbon::now()->endOfDay()
        //     ])
        //     ->count();

        // // đếm user được tạo trong tháng
        // $countUser = User::select('id')->whereBetween('created_at', [
        //     Carbon::now()->startOfMonth(),
        //     Carbon::now()->endOfMonth()
        // ])->count();

        // // user mua nhiều nhất tháng
        // $userBuyMost = User::select($this->selecedUserBill())->withCount(['bills' => function ($query) {
        //     $query->whereBetween(
        //         'created_at',
        //         [
        //             Carbon::now()->startOfMonth(),
        //             Carbon::now()->endOfMonth()
        //         ]
        //     );
        // }])->orderBy('bills_count', 'desc')->having('bills_count', '>', 0)->limit(10)->get();

        // $amount_month = 0;
        // foreach ($order as $key => $amount) {
        //     $amount_month += $amount->total_amount;
        // }

        // $countOrder = count($order);

        // $orderYear = BillModel::selectRaw(
        //     'SUM(total_amount) as total_amount,
        //             MONTH(created_at) as month, 
        //             SUM(CASE WHEN status = "success" THEN 1 ELSE 0 END) as success_count,
        //             SUM(CASE WHEN status = "cancel" THEN 1 ELSE 0 END) as cancel_count'
        // )
        //     ->whereBetween('created_at', [
        //         Carbon::now()->startOfYear(),
        //         Carbon::now()->endOfMonth()
        //     ])
        //     ->groupBy(DB::raw('MONTH(created_at)'))
        //     ->orderBy('month', 'asc')
        //     ->get();

        // return view('admin.index', compact(
        //     'countOrder',
        //     'amount_month',
        //     'countUser',
        //     'orderDayCount',
        //     'userBuyMost',
        //     // 'topSellingProducts',
        //     'orderYear'
        // ));

        $cacheDuration = 60;

        // Cache keys
        $cacheKeyOrder = 'dashboard_orders_month';
        $cacheKeyOrderDayCount = 'dashboard_orders_day_count';
        $cacheKeyCountUser = 'dashboard_users_month';
        $cacheKeyUserBuyMost = 'dashboard_top_users_month';
        $cacheKeyOrderYear = 'dashboard_orders_year';
        $cacheKeyAmountMonth = 'dashboard_total_amount_month';

        // Cache and retrieve data
        $order = Cache::remember($cacheKeyOrder, $cacheDuration, function () {
            return BillModel::select($this->seleced())->with('billDetails')
                ->with('Coupon')
                ->where('status', 'success')
                ->whereBetween('created_at', [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth()
                ])
                ->get();
        });

        $orderDayCount = Cache::remember($cacheKeyOrderDayCount, $cacheDuration, function () {
            return BillModel::select($this->seleced())->with('billDetails')
                ->with('Coupon')
                ->whereBetween('created_at', [
                    Carbon::now()->startOfDay(),
                    Carbon::now()->endOfDay()
                ])
                ->count();
        });

        $countUser = Cache::remember($cacheKeyCountUser, $cacheDuration, function () {
            return User::select('id')->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])->count();
        });

        $userBuyMost = Cache::remember($cacheKeyUserBuyMost, $cacheDuration, function () {
            return User::select($this->selecedUserBill())->withCount(['bills' => function ($query) {
                $query->whereBetween(
                    'created_at',
                    [
                        Carbon::now()->startOfMonth(),
                        Carbon::now()->endOfMonth()
                    ]
                );
            }])
                ->orderBy('bills_count', 'desc')
                ->having('bills_count', '>', 0)
                ->limit(10)
                ->get();
        });

        $amount_month = Cache::remember($cacheKeyAmountMonth, $cacheDuration, function () use ($order) {
            $amount = 0;
            foreach ($order as $key => $amountObj) {
                $amount += $amountObj->total_amount;
            }
            return $amount;
        });

        $countOrder = count($order);

        $orderYear = Cache::remember($cacheKeyOrderYear, $cacheDuration, function () {
            return BillModel::selectRaw(
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
        });

        return view('admin.index', compact(
            'countOrder',
            'amount_month',
            'countUser',
            'orderDayCount',
            'userBuyMost',
            'orderYear'
        ));
    }

    // function amount_total of month
    public function amountTotalOfMonth()
    {
        $amount_month = BillModel::select('total_amount')
            ->where('status', 'success')
            ->whereBetween('created_at', [
                Carbon::now()->startOfMonth(),
                Carbon::now()->endOfMonth()
            ])
            ->sum('total_amount');

        return response()->json($amount_month);
    }

    // get-user-buy-most
    public function getUserBuyMost(Request $request)
    {
        $payload = $request->except(['_token']);
        $monthsAgo = $payload['month'] ?? 1;
        $startDate = Carbon::now()->subMonths($monthsAgo)->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $userBuyMost = User::select($this->selecedUserBill())
            ->withCount(['bills' => function ($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }])
            ->having('bills_count', '>', 0)
            ->orderBy('bills_count', 'desc')
            ->limit(10)
            ->get();

        return response()->json($userBuyMost);
    }

    // get-order-month
    public function getOrderMonth()
    {
        // số đơn thành công
        // số đơn thấy bại
        // số đơn theo tháng

        // $orderSuccessByMonth = BillModel::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        //     ->where('status', 'success')
        //     ->whereBetween('created_at', [
        //         Carbon::now()->startOfYear(),
        //         Carbon::now()->endOfYear()
        //     ])
        //     ->groupBy(DB::raw('MONTH(created_at)'))
        //     ->orderBy('month', 'asc')
        //     ->pluck('count', 'month');

        // $orderCancelByMonth = BillModel::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        //     ->where('status', 'cancel')
        //     ->whereBetween('created_at', [
        //         Carbon::now()->startOfYear(),
        //         Carbon::now()->endOfYear()
        //     ])
        //     ->groupBy(DB::raw('MONTH(created_at)'))
        //     ->orderBy('month', 'asc')
        //     ->pluck('count', 'month');

        // $orderByMonth = BillModel::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
        //     ->whereBetween('created_at', [
        //         Carbon::now()->startOfYear(),
        //         Carbon::now()->endOfYear()
        //     ])
        //     ->groupBy(DB::raw('MONTH(created_at)'))
        //     ->orderBy('month', 'asc')
        //     ->pluck('count', 'month');

        // return response()->json([
        //     'orderSuccessByMonth' => $orderSuccessByMonth,
        //     'orderCancelByMonth' => $orderCancelByMonth,
        //     'orderByMonth' => $orderByMonth
        // ]);

        $cacheDuration = 600;

        // Cache keys
        $cacheKeySuccess = 'orderSuccessByMonth';
        $cacheKeyCancel = 'orderCancelByMonth';
        $cacheKeyTotal = 'orderByMonth';

        $orderSuccessByMonth = Cache::remember($cacheKeySuccess, $cacheDuration, function () {
            return BillModel::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->where('status', 'success')
                ->whereBetween('created_at', [
                    Carbon::now()->startOfYear(),
                    Carbon::now()->endOfYear()
                ])
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy('month', 'asc')
                ->pluck('count', 'month');
        });

        $orderCancelByMonth = Cache::remember($cacheKeyCancel, $cacheDuration, function () {
            return BillModel::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->where('status', 'cancel')
                ->whereBetween('created_at', [
                    Carbon::now()->startOfYear(),
                    Carbon::now()->endOfYear()
                ])
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy('month', 'asc')
                ->pluck('count', 'month');
        });

        $orderByMonth = Cache::remember($cacheKeyTotal, $cacheDuration, function () {
            return BillModel::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                ->whereBetween('created_at', [
                    Carbon::now()->startOfYear(),
                    Carbon::now()->endOfYear()
                ])
                ->groupBy(DB::raw('MONTH(created_at)'))
                ->orderBy('month', 'asc')
                ->pluck('count', 'month');
        });

        return response()->json([
            'orderSuccessByMonth' => $orderSuccessByMonth,
            'orderCancelByMonth' => $orderCancelByMonth,
            'orderByMonth' => $orderByMonth
        ]);
    }

    // get-top-selling-products
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
}
