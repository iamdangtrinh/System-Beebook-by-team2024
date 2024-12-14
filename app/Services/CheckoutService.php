<?php

namespace App\Services;

use App\Models\BillDetailModel;
use App\Models\config_admin;
use App\Models\couponModel;
use App\Models\Product;
use App\Services\Interfaces\CheckoutServiceInterface;
// use App\Models\User;
use App\Repositories\Interfaces\CheckoutRepositoryInterface as CheckoutRepository;
use App\Repositories\Interfaces\BillDetailRepositoryInterface as BillDetailRepository;
use App\Services\Interfaces\CartServiceInterface as CartService;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class CheckoutService
 * @package App\Services
 */
class CheckoutService implements CheckoutServiceInterface
{
      protected $CheckoutRepository;
      protected $BillDetailRepository;
      protected $CartService;
      protected $fee_shipping;

      public function __construct(CheckoutRepository $CheckoutRepository, BillDetailRepository $BillDetailRepository, CartService $CartService)
      {
            $this->CheckoutRepository = $CheckoutRepository;
            $this->BillDetailRepository = $BillDetailRepository;
            $this->CartService = $CartService;
            $this->fee_shipping = config_admin::select('value')->where('key', 'fee-shipping')->first();
      }

      private function paginateSelect()
      {
            return [
                  "id",
                  "id_user",
                  "status",
                  "reason_cancel",
                  "total_amount",
                  "payment_method",
                  "shipping_method",
                  "discount",
                  "fee_shipping",
                  "address",
                  "email",
                  "phone",
                  "name",
                  "note",
                  "note_admin",
            ];
      }

      public function create($request)
      {
            DB::beginTransaction();
            try {
                  $payload = $request->except(['_token']);
                  if (empty($payload['checkout']) || $payload['checkout'] !== 'submit_checkout') {
                        return redirect()->route('product.index')->with('error', "Vui lòng thêm sản phẩm vào giỏ hàng");
                  }
                  $carts = $this->CartService->findCartByUser(Auth::user()->id);
                  if ($carts->isEmpty()) {
                        return redirect()->route('product.index')->with('error', "Vui lòng thêm sản phẩm vào giỏ hàng");
                  }

                  $total_amount = 0;
                  $billDetails = [];
                  foreach ($carts as $cart) {
                        $total_amount += $cart->quantity * $cart->price;
                        $billDetails[] = [
                              'id_product' => $cart->id_product,
                              'quantity' => $cart->quantity,
                              'price' => $cart->price,
                        ];
                  }

                  $payload['fee_shipping'] = $this->fee_shipping->value;
                  $payload['total_amount'] = $total_amount + (session()->get('price', 0)) + ($payload['fee_shipping'] ?? 0);
                  $payload['discount'] = session()->get('price', 0);
                  $payload['id_user'] = Auth::user()->id;
                  $id_bill = $this->CheckoutRepository->create($payload)->id;

                  foreach ($billDetails as $billDetail) {
                        $billDetail['id_bill'] = $id_bill;
                        $this->BillDetailRepository->create($billDetail);
                  }

                  // $this->BillDetailRepository->insert($billDetails);
                  foreach ($carts as $cart) {
                        $updated = Product::where('id', $cart['id_product'])
                              ->where('quantity', '>=', $cart['quantity'])
                              ->decrement('quantity', $cart['quantity']);

                        if (!$updated) {
                              throw new \Exception("Sản phẩm với ID {$cart['id_product']} không đủ số lượng hoặc không tồn tại");
                        }
                  }
                  $this->CartService->destroyAll();
                  if ((session()->get('id_coupon', 0)) !== 0) {
                        $coupon = couponModel::findOrFail(session()->get('id_coupon'));
                        $coupon->decrement('quantity', 1);
                  }
                  session()->forget(['price', 'id_coupon', 'code', 'disable']);
                  DB::commit();
                  if ($payload['payment_method'] == "ONLINE") {
                        return redirect()->route('order.show', ['id' => $id_bill]);
                  } else if ($payload['payment_method'] == "OFFLINE") {
                        return redirect()->route('thankyou.index', ['id' => $id_bill]);
                  }
            } catch (\Exception $exception) {
                  DB::rollBack();
                  Log::error($exception->getMessage());
                  dd($exception->getMessage());
                  return false;
            }
      }

      // public function create($request)
      // {
      //       DB::beginTransaction();
      //       try {
      //             $payload = $this->preparePayload($request);
      //             if (!$this->isValidCheckout($payload)) {
      //                   return redirect()->route('product.index')->with('error', "Vui lòng thêm sản phẩm vào giỏ hàng");
      //             }

      //             $carts = $this->CartService->findCartByUser(Auth::user()->id);
      //             if ($carts->isEmpty()) {
      //                   return redirect()->route('product.index')->with('error', "Vui lòng thêm sản phẩm vào giỏ hàng");
      //             }

      //             $billDetails = $this->prepareBillDetails($carts);
      //             $payload['total_amount'] = $this->calculateTotalAmount($carts, $payload);

      //             $id_bill = $this->CheckoutRepository->create($payload)->id;
      //             $this->BillDetailRepository->insert(array_map(function ($billDetail) use ($id_bill) {
      //                   $billDetail['id_bill'] = $id_bill;
      //                   return $billDetail;
      //             }, $billDetails));

      //             $this->updateProductQuantities($carts);
      //             $this->CartService->destroyAll();
      //             $this->handleCoupon();

      //             session()->forget(['price', 'id_coupon', 'code', 'disable']);
      //             DB::commit();

      //             return $this->redirectAfterCheckout($payload['payment_method'], $id_bill);
      //       } catch (\Exception $exception) {
      //             DB::rollBack();
      //             Log::error($exception->getMessage());
      //             return false;
      //       }
      // }

      private function preparePayload($request)
      {
            $payload = $request->except(['_token']);
            $payload['fee_shipping'] = $this->fee_shipping;
            $payload['discount'] = session()->get('price', 0);
            $payload['id_user'] = Auth::user()->id;
            return $payload;
      }

      private function isValidCheckout($payload)
      {
            return !empty($payload['checkout']) && $payload['checkout'] === 'submit_checkout';
      }

      private function prepareBillDetails($carts)
      {
            return $carts->map(function ($cart) {
                  return [
                        'id_product' => $cart->id_product,
                        'quantity' => $cart->quantity,
                        'price' => $cart->price,
                  ];
            })->toArray();
      }

      private function calculateTotalAmount($carts, $payload)
      {
            $total_amount = $carts->sum(function ($cart) {
                  return $cart->quantity * $cart->price;
            });
            return $total_amount + session()->get('price', 0) + ($payload['fee_shipping'] ?? 0);
      }

      private function updateProductQuantities($carts)
      {
            foreach ($carts as $cart) {
                  $updated = Product::where('id', $cart['id_product'])
                        ->where('quantity', '>=', $cart['quantity'])
                        ->decrement('quantity', $cart['quantity']);

                  if (!$updated) {
                        throw new \Exception("Sản phẩm với ID {$cart['id_product']} không đủ số lượng hoặc không tồn tại");
                  }
            }
      }

      private function handleCoupon()
      {
            if (session()->get('id_coupon', 0) !== 0) {
                  $coupon = couponModel::findOrFail(session()->get('id_coupon'));
                  $coupon->decrement('quantity', 1);
            }
      }

      private function redirectAfterCheckout($payment_method, $id_bill)
      {
            if ($payment_method == "ONLINE") {
                  return redirect()->route('order.show', ['id' => $id_bill]);
            } else if ($payment_method == "OFFLINE") {
                  return redirect()->route('thankyou.index', ['id' => $id_bill]);
            }
      }

      public function update($id, $request)
      {
            DB::beginTransaction();
            try {
                  $payload = $request->except(['_token', 'send']);
                  $user = $this->CheckoutRepository->update($id, $payload);
                  DB::commit();
                  return true;
            } catch (\Exception $exception) {
                  DB::rollBack();
                  echo $exception->getMessage();
                  return false;
            }
      }

      public function destroy($id)
      {
            DB::beginTransaction();
            try {
                  $user = $this->CheckoutRepository->delete($id);
                  DB::commit();
                  return true;
            } catch (\Exception $exception) {
                  DB::rollBack();
                  echo $exception->getMessage();
                  return false;
            }
      }
}
