<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\User;

class CheckoutController extends Controller
{
    public function index()
    {
        //out of stock deleted
        $old_cartitems = Cart::where('user_id', Auth::id())->get();
 
        foreach($old_cartitems as $item)
        {
            if(!Product::where('id',$item->prod_id)->where('qty','>=',$item->prod_qty)->exists())
            {
                $removeItem = Cart::where('user_id', Auth::id())->where('prod_id',$item->prod_id)->first();
                $removeItem->delete();
            }
        }

        //$total = Orderall();//all data fetch in DB
        $cartitems = Cart::where('user_id', Auth::id())->get();
        return view('frontend.checkout', compact('cartitems'));
        
    }




    public function placeorder(Request $request)
    {
        $order = new Order();
        $order->user_id = Auth::id();
        $order->fname = $request->input('fname');
        $order->lname = $request->input('lname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address1 = $request->input('address1');
        $order->address2 = $request->input('address2');
        $order->city = $request->input('city');
        $order->state = $request->input('state');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');

        //to calculate the total price---totsl price show in phpmyadmin
        $total = 0;
        $cartitems_total = Cart::where('user_id', Auth::id())->get();
        foreach($cartitems_total as $prod)
        {
            $total += $prod->products->selling_price;
        }
        $order->total_price = $total;

        $order->tracking_no = 'sharma'.rand(1111,9999 );
        $order->save();


    

     $cartitems = Cart::where('user_id', Auth::id())->get();
     foreach($cartitems as $item)
     {
         OrderItems::create([

            'order_id'=> $order->id,
            'prod_id'=> $item->prod_id,
            'qty'=> $item->prod_qty,
            'price'=> $item->products->selling_price,
         ]);
         //stock to out of stock
         $prod = Product::where('id', $item->prod_id)->first();
         $prod->qty = $prod->qty - $item->prod_qty;
         $prod->update();

     }



     $cartitems = Cart::where('user_id', Auth::id())->get();
     Cart::destroy($cartitems);//delete cart

     //return redirect('/')->with('status',"Order Placed Successfully");
     return redirect('/')->with('status',"Order Placed Successfully");

    }



    public function  razorpaycheck(Request $request)
    {
       $cartitems =Cart::where('user_id', Auth::id())->get();

       $total_price = 0;
       foreach($cartitems as $item)
       {
          $total_price += $item->products->selling_price * $item->prod_qty; 
       }

       $firstname =$request->input('firstname');
       $lastname =$request->input('lastname');
       $email =$request->input('email');
       $phone =$request->input('phone');
       $address1 =$request->input('address1');
       $address2 =$request->input('address2');
       $city =$request->input('city');
       $state =$request->input('state');
       $country=$request->input('country');
       $pincode =$request->input('pincode');

       return response()->json([
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'phone' => $phone,
        'address1' => $address1,
        'address2' => $address2,
        'city' => $city,
        'state' => $state,
        'country' => $country,
        'pincode' => $pincode,
        'total_price' => $total_price
       ]);

    }


   
}