<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\SignUpRequest;
use App\Http\Requests\SignInRequest;
use Illuminate\Support\Facades\Hash;
use App\Mail\verifySignUp;
use App\Models\BillModel;
use App\Models\cartModel;
use App\Models\Product;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class ManagerUserController extends Controller
{
    public function SignIn()
    {
        return view('Client.signIn');
    }
    public function HandleSignIn(SignInRequest $request)
    {
        // if (User::where('status', 'active')->whereNotNull('email_verified_at')->first()) {
        $user = Auth::attempt(['email' => $request->email, 'password' => $request->password1]);
        if ($user === true) {
            if (Auth::user()->status === 'inactive') {
                Auth::logout();
                session()->flash('errorSignIn', 'Tài khoản của bạn đã chưa được kích hoạt !');
                return redirect('/sign-in');
            } else {
                $sessionCart = Session::get('cart', []);
                foreach ($sessionCart as $item) {
                    // Lấy thông tin sản phẩm từ database để kiểm tra số lượng tồn kho
                    $product = Product::find($item['product_id']);

                    if ($product) {
                        // Kiểm tra nếu sách đã có trong bảng carts của người dùng
                        $cartItem = cartModel::where('id_user', Auth::user()->id)
                            ->where('id_product', $item['product_id'])
                            ->first();

                        // số lượng sản phẩm
                        $newQuantity = $cartItem ? $cartItem->quantity + $item['quantity'] : $item['quantity'];
                        // cho sl sản phẩm = tối đa
                        $finalQuantity = min($newQuantity, $product->quantity);

                        if ($cartItem) {
                            // Nếu đã có, cập nhật số lượng sách và giá tiền
                            $cartItem->quantity = $finalQuantity;
                            $cartItem->price += $item['product_price'];
                            $cartItem->save();
                        } else {
                            // Nếu chưa có, sách vào bảng carts
                            cartModel::create([
                                'id_user' => Auth::user()->id,
                                'id_product' => $item['product_id'],
                                'quantity' => $finalQuantity,
                                'price' => $item['product_price'],
                            ]);
                        }
                    }
                }
                Session::forget('cart');
                if (Auth::user()->roles === 'admin') {
                    return redirect('/admin');
                } else {
                    return redirect('/profile');
                }
            }
        } else {
            session()->flash('SignInFailed', 'Tài khoản hoặc mật khẩu của bạn không đúng!');
            return redirect('/sign-in');
        }
        // } else {
        //     session()->flash('errorSignIn', 'Tài khoản của bạn chưa được kích hoạt !');
        //     return redirect('/sign-in');
        // }
    }
    public function SignUp()
    {

        return view('Client.SignUp');
    }
    public function HandleSignUp(SignUpRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'avatar' => 'no_avt.png',
                'phone' => $request->phone,
                'password' => Hash::make($request->password_confirm),
                'status' => "inactive"
            ]);
            Mail::to($request->email)->send(new verifySignUp($user->id));
            session()->flash('success-sign-up', 'Đăng ký thành công, vui lòng kiểm tra email để kích hoạt tài khoản');
            return redirect('/sign-up');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function  LogOut()
    {
        Auth::logout();
        return redirect('/sign-in');
    }
    public function Profile()
    {
        return view('Client.profile');
    }
    // verify sign up 
    public function HandleVerifySignUp($id)
    {
        try {
            User::where('id', $id)->update([
                'email_verified_at' => now(),
                'status' => 'active'
            ]);
            return redirect('/sign-in');
        } catch (\Throwable $th) {
            //throw $th;`
            dd('Không xác nhận được');
        }
    }
    // Show form reset password
    public function ResetPassword()
    {
        return view('Client.resetPassword');
    }
    public function HandleConfirm($token)
    {
        return view('Client.confirmPassword', compact('token'));
    }

    public function yourOrder()
    {
        return view('Client.your-order');
    }

    public function yourOrderDetail($id)
    {
        $orderDetails = BillModel::where('id', $id)
            ->where('id_user', Auth::user()->id)
            ->with('billDetails')
            ->with('Coupon')
            ->firstOrFail();
        return view('Client.order.detail', compact(['orderDetails']));
    }
}