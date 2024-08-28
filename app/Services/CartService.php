<?php

namespace App\Services;

use App\Services\Interfaces\CartServiceInterface;
use App\Repositories\Interfaces\CartRepositoryInterface as CartRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

/**
 * Class cartervice
 * @package App\Services
 */
class CartService implements CartServiceInterface
{
    protected $CartRepository;
    public function __construct(CartRepository $CartRepository)
    {
        $this->CartRepository = $CartRepository;
    }

    private function paginateSelect()
    {
        return ['id', 'name', 'email'];
    }

    public function paginate($request)
    {
        $perPage = $request->integer('perpage');
        $cart = $this->CartRepository->pagination(
            $this->paginateSelect(),
            [],
            [],
            ['path' => 'cart'],
            $perPage,
            );
        return $cart;
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {

            $payload = $request->except(['_token', 'send', 'repassword']);
            $payload['password'] = Hash::make($payload['password']);
            $user = $this->CartRepository->create($payload);
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
            $user = $this->CartRepository->update($id, $payload);
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
            $user = $this->CartRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            echo $exception->getMessage();
            return false;
        }
    }
}
