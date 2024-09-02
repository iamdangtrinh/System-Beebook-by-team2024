<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Http\Requests\cartRequest;
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
        return $result;
    }

    // tạo view hiển thị user
    public function edit($id)
    {
        $user = $this->CartRepository->findById($id);
        return response()->json($user);
    }

    public function update(cartRequest $request)
    {
        $result = $this->CartService->updateCart($request);

        if ($result) {
            return "Cập nhật số lượng sản phẩm thành công!";
        } else {
            return "Cập nhật số lượng sản phẩm thất bại!";
        }
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
