<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BillModel;
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
        $query = BillModel::select($this->selected());
        if (!empty($payload['order_id'])) {
            $query->where('id', $payload['order_id']);
        }

        if (!empty($payload['status'])) {
            $query->where('status', $payload['status']);
        }

        if (!empty($payload['customer'])) {
            $query->where('id_user', 'like', '%' . $payload['customer'] . '%');
        }

        if (!empty($payload['amount'])) {
            $query->where('total_amount', $payload['amount']);
        }

        $results = $query->paginate(20);

        // $results = BillModel::select($this->selected())->paginate(20);
        return view('admin.order.index', compact(['results']));
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
        //
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
            // ->where('id_user', Auth::user()->id)
            ->with('billDetails')
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
