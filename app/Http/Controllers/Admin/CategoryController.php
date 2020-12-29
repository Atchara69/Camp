<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.CategoryForm')->with('categories',Category::paginate(5));

    }

    public function store (Request $request){
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        //Insert Data to Table
        $category=new Category;
        $category->name = $request->name;
        $category->save();
        session()->flash("success","บันทึกข้อมูลเรียบร้อยแล้ว!");
        return redirect('/admin/createCategory');
    }
    public function edit($id){
        $category=Category::find($id);
        return view('admin.EditCategoryForm',['category'=>$category]);

    }
    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|unique:categories',
        ]);
        $category=Category::find($id);
        $category->name=$request->name;
        $category->save();
        session()->flash("success","อัปเดทข้อมูลเรียบร้อยแล้ว!");
        return redirect('/admin/createCategory');
    }
    public function delete($id){

        $category=Category::find($id);
        if($category->products->count()>0){
            session()->flash("warning","ไม่สามารถลบหมวดหมู่ได้! เพราะมีสินค้าใช้งานหมวดหมู่นี้");
            return redirect()->back();
        }
        $category::destroy($id);
        session()->flash("success","ลบข้อมูลเรียบร้อยแล้ว!");
        return redirect('/admin/createCategory');
    }
}
