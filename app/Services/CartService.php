<?php

namespace App\Services;

use App\Services\Interfaces\CartServiceInterface;
// use App\Models\User;
use App\Repositories\Interfaces\CartRepositoryInterface as CartRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UserCatalogue;

/**
 * Class UserService
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
        return [
            'id',
            'id_user',
            'id_product',
            'price',
            'quantity',
        ];
    }

    public function findCartByUser($perPage = 20)
    {
        $cart = $this->CartRepository->findCart(
            $this->paginateSelect(),
            // id của user
            1,
            $perPage
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
            $payload = $request->except(['_token']);
            $response = $this->CartRepository->update($id, $payload);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            echo $exception->getMessage();
            return false;
        }
    }
    
    public function updateCart(Request $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token']);
            $payload['id_user'] = '1';
            $response = $this->CartRepository->updateQuantityCart($payload);
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
