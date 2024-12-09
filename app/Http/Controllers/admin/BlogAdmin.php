<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogModel;
use App\Models\Taxonomy;
use App\Models\BlogMeta;
use App\Models\PostProduct;
use App\Models\Product;
use Illuminate\Support\Str;

class BlogAdmin extends Controller
{
    public function index()
    {
        return view('admin.blog.index');
    }

    function edit(string $id)
    {
        $data = BlogModel::find($id);
        $products = Product::select('id', 'name')->where('status', 'active')->get();
        $postProduct = PostProduct::select(['id_post', 'id_product'])->where('id_post', $id)->get();
        return view('admin.blog.store', compact(['data', 'products', 'postProduct']));
    }

    public function showAdd()
    {
        $products = Product::select('id', 'name')->where('status', 'active')->get();
        return view('admin.blog.add', compact('products'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image_cover' => 'nullable|string',
            'meta_title_seo' => 'nullable|string|max:255',
            'meta_description_seo' => 'nullable|string|max:255',
            'post_type' => 'required|string',
        ], [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'content.required' => 'vui lòng nhập nội dung.',
            'post_type.required' => 'Loại bài viết là bắt buộc.',
        ]);

        $payload = $request->except(['_token']);
        $payload['id_user'] = auth()->user()->id;
        $tags = ($payload['tags']) ?? [];
        $payload['tags'] = implode(',', $tags);

        if ($payload['post_type'] === 'review' && isset($payload['id_product'])) {
            $currentProductIds = PostProduct::where('id_post', $payload['id'])->pluck('id_product')->toArray();
            $incomingProductIds = $payload['id_product'];
            foreach ($incomingProductIds as $id) {
                PostProduct::updateOrCreate(
                    [
                        'id_post' => $payload['id'],
                        'id_product' => $id
                    ],
                    [
                        'id_post' => $payload['id'],
                        'id_product' => $id
                    ]
                );
            }
            $idsToDelete = array_diff($currentProductIds, $incomingProductIds);
            PostProduct::where('id_post', $payload['id'])
                ->whereIn('id_product', $idsToDelete)
                ->delete();
        }

        unset($payload['id_product']);
        $payload['slug'] = Str::slug($payload['title']);
        $result = BlogModel::create($payload)->id;
        if (!$result) {
            return redirect()->back()->with('error', 'Tạo mới blog thất bại!');
        }
        return redirect()->route('adminblog.edit', ['id' => $result])->with('success', 'Tạo mới blog thành công!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image_cover' => 'nullable|string',
            'meta_title_seo' => 'nullable|string|max:255',
            'meta_description_seo' => 'nullable|string|max:255',
            'post_type' => 'required|string',
        ], [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'content.required' => 'Nội dung là bắt buộc.',
            'post_type.required' => 'Loại bài viết là bắt buộc.',
        ]);

        $payload = $request->except(['_token']);
        $payload['id_user'] = auth()->user()->id;
        $tags = ($payload['tags']) ?? [];
        $payload['tags'] = implode(',', $tags);

        // thêm hoặc xóa sản phẩm
        if ($payload['post_type'] === 'review' && isset($payload['id_product'])) {
            $currentProductIds = PostProduct::where('id_post', $payload['id'])->pluck('id_product')->toArray();
            $incomingProductIds = $payload['id_product'];
            foreach ($incomingProductIds as $id) {
                PostProduct::updateOrCreate(
                    [
                        'id_post' => $payload['id'],
                        'id_product' => $id
                    ],
                    [
                        'id_post' => $payload['id'],
                        'id_product' => $id
                    ]
                );
            }
            $idsToDelete = array_diff($currentProductIds, $incomingProductIds);
            PostProduct::where('id_post', $payload['id'])
                ->whereIn('id_product', $idsToDelete)
                ->delete();
        }

        unset($payload['id_product']);
        $payload['slug'] = Str::slug($payload['title']);
        $result = BlogModel::where('id', $payload['id'])->update($payload);
        if (!$result) {
            return redirect()->back()->with('error', 'Cập nhật blog thất bại!');
        }
        return redirect()->back()->with('success', 'Cập nhật blog thành công!');
    }
}
