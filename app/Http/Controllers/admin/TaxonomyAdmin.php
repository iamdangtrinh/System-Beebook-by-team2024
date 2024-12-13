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
            return redirect()->back()->with('error', 'Xóa vĩnh viễn bài viết thất bại!');
        }
        return redirect()->back()->with('success', 'Xóa vĩnh viễn bài viết thành công!');
    }

}
