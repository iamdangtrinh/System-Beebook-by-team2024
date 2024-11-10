<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\cartModel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginGoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            // get user by google
            $googleUser = Socialite::driver('google')->user();
            // find user where google_id and status
            $findUser = User::where('google_id', $googleUser->id)->where('status', 'active')->first();
            if ($findUser) {
                Auth::login($findUser);
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
                return redirect('/');
            }
            // get user where email
            $user = User::where('email', $googleUser->email)->first();
            if ($user) {
                // if status is inactive
                if ($user->status === 'inactive') {
                    session()->flash('errorSignIn', 'Tài khoản của bạn đã bị khóa !');
                    return redirect('/sign-in');
                }
                // else config
                $user->google_id = $googleUser->id;
                $user->save();
                Auth::login($user);
                return redirect('/');
            } else {
                // create if don't have account
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(Str::random(16)),
                ]);
                Auth::login($user);
                return redirect('/');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
