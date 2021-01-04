<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Category;
use App\Product;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{

    public function index(){
        $cart=Session::get('cart'); //ดึงข้อมูลตะกร้าสินค้า
        return view("products.showProduct",['cartItems'=>$cart])
        ->with("products",Product::paginate(6))
        ->with("categories",Category::all()->sortBy('name')); //Descมากไปน้อย,สระจะขึ้นก่อน,sortByน้อยไปมาก
    }

    public function findCategory($id){
        $category=Category::find($id);
        return view("products.showCategory")
        ->with("categories",Category::all()->sortBy('name'))
        ->with("products",$category->products()->paginate(3))
        ->with('feature',$category->name);
    }

    public function details($id){
        return view("products.showProductdetails")
        ->with("product",Product::find($id))
        ->with("categories",Category::all()->sortBy('name'));
    }

    public function addProductToCart(Request $request,$id){
        $product=Product::find($id);
        $prevCart=$request->session()->get('cart');
        $cart=new Cart($prevCart);
        $cart->addItem($id,$product);
        $cart->updatePriceQuantity();
        //update ตะกร้าสินค้า
        $request->session()->put('cart',$cart);
        return redirect('/products/cart');
        // dd($cart);
    }

    public function addQuantityToCart(Request $request){
        $id=$request->_id;
        $quantity=$request->quantity;
        $product=Product::find($id);
        $prevCart=$request->session()->get('cart');
        $cart=new Cart($prevCart);
        $cart->addQuantity($id,$product,$quantity);
        $cart->updatePriceQuantity();
        //update ตะกร้าสินค้า
        $request->session()->put('cart',$cart);
        return redirect('/products/cart');
        // dd($cart);
    }

    public function showCart(){
        $cart=Session::get('cart'); //ดึงข้อมูลตะกร้าสินค้า
        if($cart){
            return view('products.showCart',['cartItems'=>$cart]);
        }else{
            return redirect('products');
        }
    }

    public function deleteFromCart(Request $request,$id){
        $cart=$request->session()->get('cart');
        if(array_key_exists($id,$cart->items)){
            //ลบสินค้าออกจากตะกร้า
            unset($cart->items[$id]);

        }
        //สินค้าคงเหลือ
        $afterCart=$request->session()->get('cart');
        $updateCart=new Cart($afterCart);
        $updateCart->updatePriceQuantity();
        $request->session()->put('cart',$updateCart);
        return redirect('/products/cart');
    }

    public function incrementCart(Request $request,$id){
        $product=Product::find($id);
        $prevCart=$request->session()->get('cart');
        $cart=new Cart($prevCart);
        $cart->addItem($id,$product);
        $request->session()->put('cart',$cart);
        return redirect('/products/cart');

    }

    public function decrementCart(Request $request,$id){
         $product=Product::find($id);
         $prevCart=$request->session()->get('cart');
         $cart=new Cart($prevCart); //ตะกร้าสินค้า
        //เข้าถึง Quantity สิรค้าที่เลือก
        if($cart->items[$id]['quantity']>1){
            $cart->items[$id]['quantity']=$cart->items[$id]['quantity']-1;
            //คำนวณราคารวมสินค้าใหม่
            $cart->items[$id]['totalSinglePrice']=$cart->items[$id]['quantity']*$product['price'];
            $cart->updatePriceQuantity();
            $request->session()->put('cart',$cart);
        }else{
            Session()->flash("warning","ต้องการสินค้าอย่างน้อย 1 รายการ!");
        }
        return redirect('/products/cart');
    }

    public function searchProduct(Request $request){
        $name=$request->search;
        $products=Product::where('name',"LIKE","%{$name}%")->paginate(3);
        return view("products.searchProduct")
        ->with("products",$products)
        ->with("categories",Category::all()->sortBy('name'));
    }

    public function searchProductPrice(Request $request){
        $arrPrice=explode(",",$request->price);
        $products=Product::whereBetween('price',$arrPrice)->orderBy('price');
        return view("products.showProduct")
        ->with("products",$products->paginate(3))
        ->with("categories",Category::all()->sortBy('name'));

    }
    public function checkout(){
        return view("products.checkoutPage");
    }
    public function createOrder(Request $request){
        $cart=Session::get('cart');
        $email=$request->email;
        $fname=$request->fname;
        $lname=$request->lname;
        $address=$request->address;
        $zip=$request->zip;
        $phone=$request->phone;
        $user_id=Auth::id();
        if($cart){
            $date=date("Y-m-d H:i:s");
            //data
            $newOrder=array("date"=>$date,
            "price"=>$cart->totalPrice,
            "status"=>"Not Paid",
            "del_date"=>$date,
            "fname"=>$fname,
            "lname"=>$lname,
            "address"=>$address,
            "email"=>$email,
            "zip"=>$zip,
            "phone"=>$phone,
            "user_id" =>$user_id
        );
        //insert data
        $create_Order=DB::table('orders')->insert($newOrder);
        $order_id=DB::getPDO()->lastInsertId();
        
        foreach ($cart->items as $item){
            $product_id=$item['data']['id'];
            $product_name=$item['data']['name'];
            $item_price=$item['data']['price'];
            $item_amount=$item['quantity'];


            $newOrderItem=array(
                "product_id"=>$product_id,
                "order_id"=>$order_id,
                "item_price"=>$item_price,
                "item_amount"=>$item_amount
            );
            $create_OrderItem=DB::table("orderitems")->insert($newOrderItem);
        }
        Session::forget("cart");
        $payment_info=$newOrder;
        $payment_info["order_id"]=$order_id;
        $request->session()->put("payment_info",$payment_info);
        return redirect('/products/showPayment');
    }else{
        return redirect('/products');
        }
    }
    public function showPayment(){
        $payment_info=Session::get('payment_info');
        if($payment_info['status']=='Not Paid'){
        return view("payment.paymentPage",["payment_info"=>$payment_info]);
        }else
        return view("/products");
    }
}

