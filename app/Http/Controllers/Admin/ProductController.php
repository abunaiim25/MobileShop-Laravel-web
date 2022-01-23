<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;//for delete image

class ProductController extends Controller
{
    //
    public function index()
    {
        //model
        $products = Product::all();
        return view('admin.product.index',compact('products'));//import products model
    }


    //category select add
    public function add()
    {
        //model
        $category = Category::all();
        return view('admin.product.add',compact('category'));//import category model
    }


    public function insert(Request $request)
    {

        //image handaling
        $products = new Product();//
        if($request->hasFile('image'))
        {
            $file= $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/products/',$filename);
            $products->image = $filename;
        }

        $products->cate_id = $request->input('cate_id');
        $products->name = $request->input('name');
        $products->slug = $request->input('slug');
        $products->small_description = $request->input('small_description');
        $products->description = $request->input('description');
        $products->original_price = $request->input('original_price');
        $products->selling_price = $request->input('selling_price');
        $products->tax = $request->input('tax');
        $products->qty = $request->input('qty');
        $products->status = $request->input('status') == TRUE ? '1':'0';
        $products->trending = $request->input('trending') == TRUE ? '1':'0';
        $products->meta_title = $request->input('meta_title');
        $products->meta_keywords = $request->input('meta_keywords');
        $products->meta_description = $request->input('meta_description');

        $products->save();
        return redirect('/products')->with('status',"Product Added Successfully");
    }



    public function edit($id)
    {
        $products = Product::find($id);//model
        return view('admin.product.edit', compact('products'));
    }


     //update
     public function update(Request $request, $id)
     {
         //update image
         $products = Product::find($id);//model
         if($request->hasFile('image'))
        {
            $path ='assets/uploads/products/'.$products->image;
            if(File::exists($path))//avobe import class
            {
                File::delete($path);
            }
            $file= $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/products/',$filename);
            $products->image = $filename;
        }

        $products->name = $request->input('name');
        $products->slug = $request->input('slug');
        $products->small_description = $request->input('small_description');
        $products->description = $request->input('description');
        $products->original_price = $request->input('original_price');
        $products->selling_price = $request->input('selling_price');
        $products->tax = $request->input('tax');
        $products->qty = $request->input('qty');
        $products->status = $request->input('status') == TRUE ? '1':'0';
        $products->trending = $request->input('trending') == TRUE ? '1':'0';
        $products->meta_title = $request->input('meta_title');
        $products->meta_keywords = $request->input('meta_keywords');
        $products->meta_description = $request->input('meta_description');

        $products->update();
        return redirect('/products')->with('status',"Product Updated Successfully");
     }


      //delete
    public function destroy($id)
    {
        $products = Product::find($id);//model
        if($products -> image)
        {
            $path ='assets/uploads/products/'.$products->image;
            if(File::exists($path))//avobe import class
            {
                File::delete($path);
            }
        }
        $products->delete();
        return redirect('products')->with('status',"Product deleted Successfully");
    }

}
