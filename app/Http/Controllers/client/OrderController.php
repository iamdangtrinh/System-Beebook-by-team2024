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
}
