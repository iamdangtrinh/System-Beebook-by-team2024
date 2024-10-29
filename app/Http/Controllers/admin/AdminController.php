<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
    
    public function show404()
    {
        return view('admin.404');
    }
    public function show500()
    {
        return view('admin.500');
    }

    public function blogs()
    {
        return view('admin.blogs');
    }
    public function article()
    {
        return view('admin.article');
    }

    public function dashboard_3()
    {
        return view('admin.dashboard_3');
    }
}
