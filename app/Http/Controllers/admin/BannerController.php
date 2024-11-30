<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\BannerModel;
use App\Models\BillModel;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // hiển thị danh sách banner

        $results = BannerModel::orderBy('id', 'desc')->paginate('10');
        return view('admin.banner.index', compact(['results']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        $payload = $request->except(['_token']);
        $payload['order'] = 0;
        $result = BannerModel::create($payload);
        if ($result) {
            return redirect()->route('admin.banner.index')->with('success', 'Thêm hình ảnh banner thành công!');
        }
        return redirect()->route('admin.banner.index')->with('error', 'Thêm hình ảnh banner thất bại!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $showBannerDetail = BannerModel::findOrFail($id);
        $results = BannerModel::orderBy('id', 'desc')->paginate('20');
        return view('admin.banner.store', compact(['results', 'showBannerDetail']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request)
    {
        $payload = $request->except(['_token']);
        $result = BannerModel::where('id', $payload['id'])->update([
            'image' => $payload['image'],
            'text_link' => $payload['text_link'],
            'type' => $payload['type'],
        ]);

        if ($result) {
            return redirect()->route('admin.banner.index')->with('success', 'Cập nhật hình ảnh thành công!');
        } else {
            return redirect()->route('admin.banner.index')->with('error', 'Cập nhật hình ảnh thất bại. Vui lòng thử lại!');
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $payload = $request->except(['_token']);
            if (!isset($payload['id']) || !isset($payload['status'])) {
                return response()->json(['error' => 'Invalid data provided.'], 400);
            }

            $result = BannerModel::where('id', $payload['id'])->update([
                'status' => $payload['status']
            ]);

            if ($result) {
                return response()->json(['message' => 'Cập nhật trạng thái thành công!'], 200);
            } else {
                return response()->json(['error' => 'Cập nhật trạng thái thất bại. Vui lòng thử lại!'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Đã xảy ra lỗi khi cập nhật. Vui lòng thử lại sau!'], 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = BannerModel::where('id', $id)->delete();
        if ($deleted) {
            return redirect()->route('admin.banner.index')->with('success', 'Xoá hình ảnh thành công!');
        }
        return redirect()->route('admin.banner.index')->with('error', 'Xoá hình ảnh thất bại. Vui lòng thử lại!');
    }
}
