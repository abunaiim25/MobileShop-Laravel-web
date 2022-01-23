<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function users()
    {
        $users = User::all();
        //$orders = Order::find(3);
        return view('admin.users.index',compact('users'));
    }


    public function viewuser($id)
    {
        $orders = Order::where('user_id',$id)->first();
        return view('admin.users.view', compact('orders'));
    }


}
