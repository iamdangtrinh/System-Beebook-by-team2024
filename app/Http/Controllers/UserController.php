<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = $this->userService->paginate($request);
        return response()->json($users);
    }

    public function show($id)
    {
        $user = $this->userService->findById($id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $userData = $request->only(['name', 'email', 'password']);
        $result = $this->userService->createUser($userData);
        if(!$result) {
            return 'Có lỗi xảy ra do thiếu fail';
        } else {
            return "Tạo user thành công";
        }
        // Redirect or return response
    }

    public function update(Request $request, $id)
    {
        $userData = $request->only(['name', 'email']);
        $this->userService->updateUser($id, $userData);
        
        // Redirect or return response
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        
        // Redirect or return response
    }
}
