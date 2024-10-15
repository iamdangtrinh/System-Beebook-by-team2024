<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Hiển thị danh sách các bài viết.
     */
    public function index()
    {
        // Lấy danh sách bài viết, sắp xếp theo thời gian tạo gần nhất
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Hiển thị form tạo bài viết mới.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Lưu bài viết mới vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',  // Kiểm tra hình ảnh, kích thước tối đa là 2MB
        ]);

        // Lưu bài viết mới
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->slug = Str::slug($request->input('title'));
        $post->id_user = auth()->id(); // Gán user hiện tại là tác giả bài viết

        // Xử lý upload hình ảnh nếu có
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Bài viết đã được tạo thành công.');
    }

    /**
     * Hiển thị một bài viết cụ thể.
     */
    public function show($slug)
    {
        // Tìm bài viết theo slug
        $post = Post::where('slug', $slug)->firstOrFail();

        // Tăng lượt xem
        $post->increment('views');

        // Truyền thêm biến views vào view nếu cần thiết
        $views = $post->views;

        return view('posts.show', compact('post', 'views'));
    }

    /**
     * Hiển thị form chỉnh sửa bài viết.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Cập nhật bài viết sau khi chỉnh sửa.
     */
    public function update(Request $request, Post $post)
    {
        // Validate dữ liệu
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        // Cập nhật bài viết
        $post->title = $request->input('title');
        $post->content = $request->input('content');

        // Cập nhật hình ảnh nếu có thay đổi
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $post->image = $imagePath;
        }

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    /**
     * Xóa một bài viết.
     */
    public function destroy(Post $post)
    {
        // Xóa bài viết
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Bài viết đã được xóa.');
    }
}
