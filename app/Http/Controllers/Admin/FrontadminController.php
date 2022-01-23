<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class FrontadminController extends Controller
{
    public function index()
    {
        //resources\views\admin\index.blade.php
        return view('admin.index');
    }
}
