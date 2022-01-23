<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();//category model add
        //resources\views\admin\category\index.blade.php
        return view('admin.category.index', compact('category'));//compact('category') add for Fetch
    }


    public function add()
    {
        //resources\views\admin\category\add.blade.php
        return view('admin.category.add');
    }



    public function insert(Request $request)
    {
        //resources\views\admin\category\add.blade.php
        //image handaling
        $category = new Category();//app\Models\Category.php
        if($request->hasFile('image'))
        {
            $file= $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category/',$filename);
            $category->image = $filename;
        }

        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? '1':'0';
        $category->popular = $request->input('popular') == TRUE ? '1':'0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_descrip = $request->input('meta_descrip');

        $category->save();
        return redirect('categories')->with('status',"Category Added Successfully");
    }





    public function edit($id)
    {
        $category = Category::find($id);//model
        return view('admin.category.edit', compact('category'));
    }


    //update
    public function update(Request $request, $id)
    {
        //update image
        $category = Category::find($id);//model
        if($request->hasFile('image'))
        {
            $path ='assets/uploads/category/'.$category->image;
            if(File::exists($path))//avobe import class
            {
                File::delete($path);
            }
            $file= $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/category/',$filename);
            $category->image = $filename;
        }

        //update data
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        $category->status = $request->input('status') == TRUE ? '1':'0';
        $category->popular = $request->input('popular') == TRUE ? '1':'0';
        $category->meta_title = $request->input('meta_title');
        $category->meta_keywords = $request->input('meta_keywords');
        $category->meta_descrip = $request->input('meta_descrip');

        $category->update();
        return redirect('/categories')->with('status',"Category Updated Successfully");
    }



    //delete
    public function destroy($id)
    {
        $category = Category::find($id);//model
        if($category -> image)
        {
            $path ='assets/uploads/category/'.$category->image;
            if(File::exists($path))//avobe import class
            {
                File::delete($path);
            }
        }
        $category->delete();
        return redirect('categories')->with('status',"Category deleted Successfully");
    }
}
