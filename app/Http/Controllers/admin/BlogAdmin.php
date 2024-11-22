<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogModel;
use App\Models\Taxonomy;
use App\Models\BlogMeta;


class BlogAdmin extends Controller
{
    public function index() {
        return view('admin.blog.index');

        
    }
    // protected function selected()
    // {
    //     return [
    //         "id",
    //         "title",
    //         "content",
    //         "tags",
    //         "image",
    //         "slug",
    //         'status',
    //         "hot",
    //         "meta_title_seo",
    //         "meta_description_seo",
    //         "id_user",
    //         "created_at",
    //         "updated_at",
    //         "delete_at"
    //     ];
    // }

    // public function index()
    // {
    //     $blogs = BlogModel::orderBy('created_at', 'desc')->paginate(12);
    //     return view('admin.blog.index', compact('blog'));
    // }

    // public function add()
    // {
    //     $blogs = BlogModel::where('status', 'active')->get();
    //     $authors = Taxonomy::where('type', 'author')->get();
    //     return view('admin.blog.add', compact('categories', 'authors'));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'slug' => 'required|string|max:255|unique:blogs,slug|regex:/^[a-z0-9-]+$/',
    //         'category_id' => 'required|integer|exists:categories,id',
    //         'content' => 'required',
    //         'image_cover' => 'nullable|string',
    //         'meta_title_seo' => 'nullable|string|max:255',
    //         'meta_description_seo' => 'nullable|string|max:255',
    //     ], [
    //         'title.required' => 'Tiêu đề là bắt buộc.',
    //         'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
    //         'slug.required' => 'Slug là bắt buộc.',
    //         'slug.max' => 'Slug không được vượt quá 255 ký tự.',
    //         'slug.unique' => 'Slug này đã tồn tại, vui lòng chọn slug khác.',
    //         'slug.regex' => 'Slug không được có khoảng trắng, dấu và ký tự đặc biệt.',
    //         'category_id.required' => 'Danh mục là bắt buộc.',
    //         'content.required' => 'Nội dung là bắt buộc.',
    //     ]);

    //     $blog = new BlogMeta();
    //     $blog->title = $request->title;
    //     $blog->slug = $request->slug;
    //     $blog->category_id = $request->category_id;
    //     $blog->content = $request->content;
    //     $blog->image_cover = $request->image_cover;
    //     $blog->meta_title_seo = $request->meta_title_seo;
    //     $blog->meta_description_seo = $request->meta_description_seo ?: substr($request->content, 0, 150);
    //     $blog->status = $request->status;
    //     $blog->hot = $request->hot;
    //     $blog->save();

    //     // Lưu meta dữ liệu cho blog (nếu cần)
    //     if ($request->meta && !empty($request->meta)) {
    //         $meta = new BlogMeta();
    //         $meta->blog_id = $blog->id;
    //         $meta->meta_key = 'extra_info';
    //         $meta->meta_value = $request->meta;
    //         $meta->save();
    //     }

    //     return redirect()->route('adminblog.index')->with('success', 'Thêm blog thành công!');
    // }
}
