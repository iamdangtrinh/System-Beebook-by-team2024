<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
// use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\UserCatalogue;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    private function paginateSelect()
    {
        return ['id', 'name', 'email'];
    }

    public function paginate($request)
    {
        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = addslashes($request->input('publish'));
        $perPage = $request->integer('perpage');
        $users = $this->userRepository->pagination(
            $this->paginateSelect(),
            $condition,
            [],
            ['path' => 'user/index'],
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
            $user = $this->userRepository->create($payload);
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
            // định dạng lại date
            $user = $this->userRepository->update($id, $payload);
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
            $user = $this->userRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            echo $exception->getMessage();
            return false;
        }
    }
}
