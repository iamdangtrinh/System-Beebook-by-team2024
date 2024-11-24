<?php

namespace App\Services;

use App\Models\BillDetailModel;
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

      public function __construct(CheckoutRepository $CheckoutRepository, BillDetailRepository $BillDetailRepository, CartService $CartService)
      {
            $this->CheckoutRepository = $CheckoutRepository;
            $this->BillDetailRepository = $BillDetailRepository;
            $this->CartService = $CartService;
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

      public function paginate($request)
      {
            $perPage = $request->integer('perpage');
            $users = $this->CheckoutRepository->pagination(
                  $this->paginateSelect(),
                  [],
                  [],
                  ['path' => 'users'],
                  $perPage,
            );
            return $users;
      }

      public function create($request)
      {
            DB::beginTransaction();
            try {
                  $payload = $request->except(['_token']);
                  if (empty($payload['checkout']) || $payload['checkout'] !== 'submit_checkout') {
                        return redirect()->route('product.index')->with('error', "Vui lòng thêm sản phẩm vào giỏ hàng");
                  }
                  $carts = $this->CartService->findCartByUser(Auth::id());
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

                  if ($total_amount < 1000000) {
                        $total_amount += env('fee_shipping');
                        $payload['fee_shipping'] = env('fee_shipping');
                  } else {
                        $payload['fee_shipping'] = 0;
                  }
                  
                  $payload['total_amount'] = $total_amount;
                  $payload['id_user'] = Auth::user()->id;
                  
                  $id_bill = $this->CheckoutRepository->create($payload)->id;
                  $billDetails = array_map(function ($billDetail) use ($id_bill) {
                        $billDetail['id_bill'] = $id_bill;
                        return $billDetail;
                  }, $billDetails);

                  $this->BillDetailRepository->insert($billDetails);
                  foreach ($carts as $cart) {
                        $updated = Product::where('id', $cart['id_product'])
                              ->where('quantity', '>=', $cart['quantity'])
                              ->decrement('quantity', $cart['quantity']);

                        if (!$updated) {
                              throw new \Exception("Sản phẩm với ID {$cart['id_product']} không đủ số lượng hoặc không tồn tại");
                        }
                  }
                  $this->CartService->destroyAll();
                  DB::commit();
                  if ($payload['payment_method'] == "ONLINE") {
                        return redirect()->route('order.show', ['id' => $id_bill]);
                  } else if ($payload['payment_method'] == "OFFLINE") {
                        // duyệt
                        Mail::to(env('MAIL_ADMIN'))->send(new \App\Mail\NewOrderAdminEmail($id_bill));
                        Mail::to($payload['email'])->send(new \App\Mail\sendEmailOrder($id_bill));
                        return redirect()->route('thankyou.index', ['id' => $id_bill]);
                  }
            } catch (\Exception $exception) {
                  DB::rollBack();
                  Log::error($exception->getMessage());
                  return false;
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
