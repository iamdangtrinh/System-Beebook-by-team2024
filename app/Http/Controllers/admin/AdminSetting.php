<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\config_admin;
use Illuminate\Http\Request;

class AdminSetting extends Controller
{

    protected function selected()
    {
        return [
            'key',
            'value'
        ];
    }

    public function index()
    {
        $email_admin = config_admin::select($this->selected())->where('key', 'email_admin')->first() ?? null;
        $feeShipping = config_admin::select($this->selected())->where('key', 'fee-shipping')->first() ?? null;;
        return view('admin.setting.index', compact('email_admin', 'feeShipping'));
    }

    public function udpate(Request $request)
    {
        // validate 
        $request->validate([
            'email_admin' => 'required|email',
            'fee-shipping' => 'required|numeric'
        ], [
            'email_admin.required' => 'Email không được để trống',
            'email_admin.email' => 'Email không đúng định dạng',
            'fee-shipping.required' => 'Phí vận chuyển không được để trống',
            'fee-shipping.numeric' => 'Phí vận chuyển phải là số'
        ]);
        try {
            $payload = $request->except('_token');
            foreach ($payload as $key => $value) {
                config_admin::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }
            return redirect()->back()->with('success', 'Cập nhật cấu hình thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi vui lòng thử lại!');
        }
    }
}
