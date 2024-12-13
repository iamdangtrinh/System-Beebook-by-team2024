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

class TaxonomyAdmin extends Controller
{
    // public function index()
    // {
    //     return view('admin.taxonomy.index');
    // }

    public function author()
    {
        // lấy 20 từ bảng taxonomy với type bằng author
        $taxonomies = Taxonomy::where('type', 'author')->paginate(20);
        // Truyền dữ liệu vào view, bao gồm dữ liệu phân trang
        return view('admin.taxonomy.author', compact('taxonomies'));
    }


    public function translator()
    {
        $taxonomies = Taxonomy::where('type', 'translator')->paginate(20);
        // Truyền dữ liệu vào view, bao gồm dữ liệu phân trang
        return view('admin.taxonomy.translator', compact('taxonomies'));
    }


    public function manufacturer()
    {
        $taxonomies = Taxonomy::where('type', 'manufacturer')->paginate(20);
        // Truyền dữ liệu vào view, bao gồm dữ liệu phân trang
        return view('admin.taxonomy.manufacturer', compact('taxonomies'));
    }

    public function forceDelete(string $id)
    {
        $result = Taxonomy::where('id', $id)->forceDelete();
        if (!$result) {
            return redirect()->back()->with('error', 'Xóa vĩnh viễn danh mục thất bại!');
        }
        return redirect()->back()->with('success', 'Xóa vĩnh viễn danh mục thành công!');
    }

    public function edit(string $id)
    {
        $taxonomy = Taxonomy::FindOrFail($id);
        return view('admin.taxonomy.edit', compact('taxonomy'));
    }

    public function update(Request $request, string $id)
    {
        $message = [
            'name.required' => 'Tên danh mục không được để trống',
            'slug.required' => 'Đường dẫn không được để trống',
            'type.required' => 'Loại danh mục không được để trống',
        ];

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'type' => 'required',
        ], $message);

        $taxonomy = Taxonomy::FindOrFail($id);
        $result = $taxonomy->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'type' => $request->type,
        ]);

        if (!$result) {
            return redirect()->back()->with('error', 'Cập nhật danh mục thất bại!');
        }
        return redirect()->back()->with('success', 'Cập nhật danh mục thành công!');
    }

    public function add(Request $request)
    {
        $message = [
            'name.required' => 'Tên danh mục không được để trống',
            'slug.required' => 'Đường dẫn không được để trống',
            'type.required' => 'Loại danh mục không được để trống',
        ];

        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'type' => 'required',
        ], $message);

        $result = Taxonomy::create([
            'name' => $request->name,
            'slug' => Str::slug($request->slug),
            'type' => $request->type,
        ]);

        if (!$result) {
            return redirect()->back()->with('error', 'Thêm danh mục thất bại!');
        }
        return redirect()->back()->with('success', 'Thêm danh mục thành công!');
    }
}
