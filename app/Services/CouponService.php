<?php

namespace App\Services;

use App\Services\Interfaces\CouponServiceInterface;
// use App\Models\User;
use App\Repositories\Interfaces\CouponRepositoryInterface as CouponRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements CouponServiceInterface
{
      protected $couponRepository;
      public function __construct(CouponRepository $CouponRepository)
      {
            $this->couponRepository = $CouponRepository;
      }

      private function paginateSelect()
      {
            return [
                  "id",
                  "code_coupon",
                  "description",
                  "start_date",
                  "expires_at",
                  "coupon_min_spend",
                  "coupon_max_spend",
                  "discount",
                  "type_coupon",
                  "quantity",
                  "status",
            ];
      }

      public function paginate($request)
      {
            $perPage = $request->integer('perpage');
            $users = $this->couponRepository->pagination(
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
                  $payload = $request->except(['_token', 'send', 'repassword']);
                  $payload['password'] = Hash::make($payload['password']);
                  $user = $this->couponRepository->create($payload);
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
                  $user = $this->couponRepository->update($id, $payload);
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
                  $user = $this->couponRepository->delete($id);
                  DB::commit();
                  return true;
            } catch (\Exception $exception) {
                  DB::rollBack();
                  echo $exception->getMessage();
                  return false;
            }
      }
}
