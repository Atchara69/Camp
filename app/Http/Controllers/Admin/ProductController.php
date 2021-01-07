<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyIsCategory')->only(['create', 'store']);
    }
    public function index()
    {
        return view('admin.ProductDashboard')->with('products', Product::paginate(5));
    }
    public function create()
    {
        return view('admin.ProductForm')->with('categories', Category::all());
    }
    // Edit Product
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.editProductForm')
            ->with('categories', Category::all())
            ->with('product', Product::find($id));
    }

    // edit image product
    public function editImage($id)
    {
        return view('admin.editProductImage')->with('product', Product::find($id));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        if ($request->category) {
            $product->category_id = $request->category;
        }

        $product->save();
        Session()->flash("success", "อัปเดทข้อมูลเรียบร้อยแล้ว!");
        return redirect('/admin/dashboard');
    }
    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:5000'
        ]);

        if ($request->hasFile("image")) {


            $imageName = time() . '.' . $request->image->extension(); //rename

            $request->image->move(public_path('images/product_image'), $imageName);

            $product = Product::find($id);
            $product->image = $imageName;
            $product->save();

            // $exists=Storage::disk('local')->exists("public/product_image/".$product->image); //เจอไฟล์ภาพชื่อเกมือนกัน
            // if($exists){
            //     // Storage::delete("public/product_image/".$product->image);
            //     unlink(public_path('images/product_image/'.$product->image));
            // }
            // $request->image->storeAs("public/product_image/",$product->image);
            return redirect('/admin/dashboard');
        }
    }
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|file|image|mimes:jpeg,png,jpg|max:5000'
        ]);
        // convert image name
        $stringImageReFormat = base64_encode('_' . time());
        $ext = $request->file('image')->getClientOriginalExtension();
        $imageName = $stringImageReFormat . "." . $ext;
        $imageEncoded = File::get($request->image);

        // upload & insert
        Storage::disk('local')->put('public/product_image/' . $imageName, $imageEncoded);

        //Insert
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->image = $imageName;
        $product->save();
        //flash Message
        session()->flash("success", "บันทึกข้อมูลเรียบร้อยแล้ว!");
        return redirect('/admin/dashboard');
    }
    public function delete($id)
    {
        $product = Product::find($id);
        $exists = Storage::disk('local')->exists("public/product_image/" . $product->image); //เจอไฟล์ภาพชื่อเกมือนกัน
        if ($exists) {
            Storage::delete("public/product_image/" . $product->image);
        }
        Product::destroy($id);
        session()->flash("success", "ลบข้อมูลเรียบร้อยแล้ว!");
        return redirect('admin/dashboard');
    }
}
