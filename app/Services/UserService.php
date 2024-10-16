<?php

namespace App\Services;

use App\Models\User;
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
        $perPage = $request->integer('perpage');
        $users = $this->userRepository->pagination(
            $this->paginateSelect(),
            [],
            [],
            ['path' => 'users'],
            $perPage,
            );
        return $users;
    }

    public function create()
    {
        dd('hello');
        // $user = User::create($data);
        //     DB::commit();
        //     return response()->json([
        //         'success' => true,
        //         'data' => $user,
        //         'message' => 'User created successfully',
        //     ], 201);
        // DB::beginTransaction();
        // try {
        //     $user = User::create($data);
        //     DB::commit();
        //     return response()->json([
        //         'success' => true,
        //         'data' => $user,
        //         'message' => 'User created successfully',
        //     ], 201);
        // } catch (\Exception $exception) {
        //     DB::rollBack();
        //     return response()->json([
        //         'success' => false,
        //         'message' => $exception->getMessage(),
        //     ], 500);
        // }
    }
    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token', 'send']);
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
