<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;


//my order nav
class UserController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();
        $payments=Payment::latest()->get();
        return view('frontend.orders.index', compact('orders','payments'));
    }


    public function view($id)
    {
        $orders = Order::where('id',$id)->where('user_id', Auth::id())->first();
        return view('frontend.orders.view', compact('orders'));
    }
}
