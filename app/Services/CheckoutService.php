<?php

namespace App\Services;

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
                  if (!empty($payload['checkout']) || $payload['checkout'] !== 'submit_checkout') {
                        if ($payload['payment_method'] == "ONLINE") {
                              // sang trang thanh toán online
                              dd("TT ONLINE");
                              

                        }
                        // lấy sp từ giỏ hàng
                        $carts = $this->CartService->findCartByUser(100);
                        // số tiền là 0
                        $total_amount = 0;
                        $billDetails = [];
                        // $payload['payment_method'];
                        foreach ($carts as $cart) {
                              $total_amount += $cart->quantity * $cart->price;
                              $billDetails[] = [
                                    'id_product' => $cart->id_product,
                                    'quantity' => $cart->quantity,
                                    'price' => $cart->price,
                              ];
                        }

                        // tính phí vận chuyển
                        if ($total_amount < 1000000) {
                              $total_amount += 20000;
                              $payload['fee_shipping'] = 20000;
                        } else {
                              $payload['fee_shipping'] = 0;
                        }
                        
                        $payload['total_amount'] = $total_amount;
                        $payload['id_user'] = Auth::user()->id;
                        // tạo bills
                        $id_bill = $this->CheckoutRepository->create($payload)->id;
                        
                        // Lưu từng chi tiết sản phẩm vào bảng bill_details
                        foreach ($billDetails as $billDetail) {
                              $billDetail['id_bill'] = $id_bill;
                              $this->BillDetailRepository->create($billDetail);
                        }
                        // xóa giỏ hàng trong database
                        $carts = $this->CartService->destroyAll();
                        // chuyển sang trang thank you
                  };
                  DB::commit();
                  return redirect()->route('thankyou.index', ['id' => base64_encode($id_bill)])->with('success', "Bạn đã đặt hàng thành công");
                  return true;
            } catch (\Exception $exception) {
                  DB::rollBack();
                  echo $exception->getMessage();
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
