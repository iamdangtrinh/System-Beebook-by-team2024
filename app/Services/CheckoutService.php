<?php

namespace App\Services;

use App\Services\Interfaces\CheckoutServiceInterface;
// use App\Models\User;
use App\Repositories\Interfaces\CheckoutRepositoryInterface as CheckoutRepository;
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
      public function __construct(CheckoutRepository $CheckoutRepository)
      {
            $this->CheckoutRepository = $CheckoutRepository;
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
                  // $payload = $request->except(['_token']);
                  // // if (Auth::user()) {
                  // $payload['id_user'] = 1;
                  // $payload['total_amount'] = 200000;
                  // $payload['address'] = 1;
                  // $payload['phone'] = 1;
                  // $payload['name'] = 1;
                  // return $this->CheckoutRepository->create($payload);
                  // } else {
                  //       return redirect('/sign-in')->with('error', 'Vui lòng đăng nhập để thực hiện!');
                  // }
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
