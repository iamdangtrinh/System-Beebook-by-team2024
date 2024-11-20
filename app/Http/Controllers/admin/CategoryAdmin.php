<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryAdmin extends Controller
{
    public function Index()
    {
        return view('admin.category.index');
    }
}