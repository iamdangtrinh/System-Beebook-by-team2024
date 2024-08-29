<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\CartServiceInterface as CartService;
use App\Repositories\Interfaces\CartRepositoryInterface as CartRepository;


class cartController extends Controller
{
    protected $CartService;
    protected $CartRepository;
    public function __construct(
        CartService $CartService,
        CartRepository $CartRepository
    ) {
        $this->CartService = $CartService;
        $this->CartRepository = $CartRepository;
    }

    public function index()
    {
        $result = $this->CartService->findCartByUser(20);

        return view('Client.cart', compact([
            'result'
        ]));
    }

    // tạo view user
    public function create() {}

    //   tạo user
    public function store(Request $request)
    {
        $result = $this->CartService->create($request);
        if ($result) {
            return response()->json("Thành công");
        } else {
            return response()->json("thất bại");
        }
    }

    // tạo view hiển thị user
    public function edit($id)
    {
        $user = $this->CartRepository->findById($id);
        return response()->json($user);
    }

    // cập nhật tài khoản user
    public function update($id, Request $request)
    {
        if ($this->CartService->update($id, $request)) {
            return redirect()->route('user.index')->with('success', 'Update user success');
        }
        return redirect()->route('user.index')->with('error', 'Update user error');
    }

    public function delete($id)
    {
        $seo = config('apps.user.delete');
        $user = $this->CartRepository->findById($id);
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
        $user = $this->CartRepository->delete($id);
    }

    public function destroy($id)
    {
        if ($this->CartService->destroy($id)) {
            return redirect()->route('user.index')->with('success', 'Delete user success');
        }
        return redirect()->route('user.index')->with('error', 'Delete user error, please again');
    }
}
