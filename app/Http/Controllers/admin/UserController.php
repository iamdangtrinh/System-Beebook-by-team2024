<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $UserService;
    protected $provinceRepository;
    protected $userRepository;
    public function __construct(UserService $userService, UserRepository $userRepository)
    {
        $this->UserService = $userService;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $users = $this->UserService->paginate($request);
        return view('welcome', compact('users'));

        // return response()->json($users);
    }

    // tạo view user
    public function create()
    {

    }

    //   tạo user
    public function store(Request $request)
    {
        $result = $this->UserService->create($request);
        if($result) {
            return response()->json("Thành công");
        } else {
            return response()->json("thất bại");
        }


        // if ($this->UserService->create($request)) {
        //     return redirect()->route('user.index')->with('success', 'Create user success');
        // }
    }

    // tạo view hiển thị user
    public function edit($id)
    {
        $user = $this->userRepository->findById($id);
        return response()->json($user);
    }

    // cập nhật tài khoản user
    public function update($id,Request $request)
    {
        if ($this->UserService->update($id, $request)) {
            return redirect()->route('user.index')->with('success', 'Update user success');
        }
        return redirect()->route('user.index')->with('error', 'Update user error');
    }

    public function delete($id)
    {
        $seo = config('apps.user.delete');
        $user = $this->userRepository->findById($id);
        $template = 'backend.user.user.delete';
        return view(
            'backend.dashboard.layout',
            compact(
                'template',
                'seo',
                'user',
            )
        );
    }
    
    public function deleteSoft($id)
    {
        $seo = config('apps.user.delete');
        $user = $this->userRepository->delete($id);
        
    }

    public function destroy($id)
    {
        if ($this->UserService->destroy($id)) {
            return redirect()->route('user.index')->with('success', 'Delete user success');
        }
        return redirect()->route('user.index')->with('error', 'Delete user error, please again');
    }

    private function configData()
    {
        return [
            'js' => [
                '/backend/plugin/ckfinder_2/ckfinder.js',
                // '/backend/plugin/ckfinder_2/config.js',
                '/backend/js/library/finder.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js',
                '/backend/js/library/location.js'
            ],
            'css' => ['https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'],
        ];
    }
}
