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
                              // echo "TT ONLINE";
                        }

                        $payload['id_user'] = Auth::user()->id;
                        $carts = $this->CartService->findCartByUser(20);
                        
                        $total_amount = 0;
                        foreach ($carts as $cart) {
                              $total_amount += $cart->price;
                        }
                        $payload['price'] = 200000;
                        $payload['total_amount'] = $total_amount;
                        
                        $payload['id_product'] = 2;
                        $payload['image_cover'] = "No image";
                        $payload['quantity'] = 1;


                        $id_bill = $this->CheckoutRepository->create($payload)->id;
                        $payload['id_bill'] = $id_bill;
                        $this->BillDetailRepository->create($payload);
                  } else {
                        echo 'ko duoc';
                  }
                  DB::commit();
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
