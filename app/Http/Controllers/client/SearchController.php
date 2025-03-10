<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Taxonomy;
use App\Models\BlogModel;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('query');

        // Nếu không có query, điều hướng đến route product.index
        if (empty($query)) {
            return redirect()->route('product.index');
        }

        // Tìm kiếm sách theo tên
        $books = Product::where('name', 'like', "%{$query}%")
            ->orderByRaw("status = 'inactive' ASC, quantity <= 0 ASC")
            ->get();

        // dd($books);
        $blogs = BlogModel::where('title', 'like', "%{$query}%")->get();

        // Tìm kiếm tác giả
        $authors = Taxonomy::where('name', 'like', "%{$query}%")
            ->where('type', 'author') // Giả sử bạn có cột `type` để phân biệt loại taxonomy
            ->get();

        // Tìm kiếm nhà xuất bản
        $publishers = Taxonomy::where('name', 'like', "%{$query}%")
            ->where('type', 'manufacturer')
            ->get();

        return view('Client.search', compact('query', 'books', 'blogs', 'authors', 'publishers'));
    }

    public function ajaxSearch(Request $request)
    {
        $query = $request->get('query');

        // Tìm kiếm sách theo tên
        $books = Product::where('name', 'like', "%{$query}%")
            ->orderByRaw("status = 'inactive' ASC, quantity <= 0 ASC")
            ->limit(6)
            ->get();
        $blogs = BlogModel::where('title', 'like', "%{$query}%")->limit(3)->get();

        // Tìm kiếm tác giả
        $authors = Taxonomy::where('name', 'like', "%{$query}%")
            ->where('type', 'author')
            ->limit(6)
            ->get();

        // Tìm kiếm nhà xuất bản
        $publishers = Taxonomy::where('name', 'like', "%{$query}%")
            ->where('type', 'manufacturer')
            ->limit(6)
            ->get();

        return response()->json([
            'books' => $books,
            'blogs' => $blogs,
            'authors' => $authors,
            'publishers' => $publishers,
        ]);
    }
}
