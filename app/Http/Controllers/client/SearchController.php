<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Taxonomy;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('query');

        // Tìm kiếm sách theo tên
        $books = Product::where('name', 'like', "%{$query}%")->get();

        // Tìm kiếm tác giả
        $authors = Taxonomy::where('name', 'like', "%{$query}%")
            ->where('type', 'author') // Giả sử bạn có cột `type` để phân biệt loại taxonomy
            ->get();

        // Tìm kiếm nhà xuất bản
        $publishers = Taxonomy::where('name', 'like', "%{$query}%")
            ->where('type', 'manufacturer')
            ->get();

        return view('search.index', compact('books', 'authors', 'publishers'));
    }

    public function ajaxSearch(Request $request)
    {
        $query = $request->get('query');

        // Tìm kiếm sách theo tên
        $books = Product::where('name', 'like', "%{$query}%")->limit(6)->get();

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
            'authors' => $authors,
            'publishers' => $publishers,
        ]);
    }
}
