<?php
namespace App;
class Cart{

    public $items; //เป็นArray ไว้รองรับสินค้าหลายชิ้น
    public $totalQuantity; //จำนวนสินค้าในตะกร้า
    public $totalPrice; //จำนวนราคารวม

    public function __construct($prevCart){
        //ตะกร้าเก่า
        if($prevCart!=null){
            $this->items=$prevCart->items;
            $this->totalQuantity=$prevCart->totalQuantity;
            $this->totalPrice=$prevCart->totalPrice;
        }else{
            //ตะกร้าใหม่
        $this->items=[];
        $this->totalQuantity=0;
        $this->totalPrice=0;
        }
    }
    public function addItem($id,$product){
        $price=(int)($product->price);
        if(array_key_exists($id,$this->items)){
            $productToAdd=$this->items[$id];
            $productToAdd['quantity']++; //เพิ่มจำนวนในรายการสินค้า
            $productToAdd['totalSinglePrice']=$productToAdd['quantity']*$price;
        }else{
            $productToAdd=['quantity'=>1,'totalSinglePrice'=>$price,'data'=>$product];
        }
        $this->items[$id]=$productToAdd;
        $this->totalQuantity++;
        $this->totalPrice=$this->totalPrice+$price;
    }

    public function addQuantity($id,$product,$amount){
       if($amount>0){
        $price=(int)($product->price);
        if(array_key_exists($id,$this->items)){
            $productToAdd=$this->items[$id];
            $productToAdd['quantity']+=$amount; //เพิ่มจำนวนในรายการสินค้า
            $productToAdd['totalSinglePrice']=$productToAdd['quantity']*$price;
        }else{
            $productToAdd=['quantity'=>$amount,'totalSinglePrice'=>$price*$amount,'data'=>$product];
        }
       }
        $this->items[$id]=$productToAdd;
        $this->totalQuantity+=$amount;
        $this->totalPrice=$this->totalPrice+$price;
    }

    public function updatePriceQuantity(){
         $totalPrice=0;
         $totalQuantity=0;
         //จำนวนสินค้าในตะกร้า
         //ราคารวม

         foreach($this->items as $item){
             $totalQuantity=$totalQuantity+$item['quantity']; //จำนวนสินค้ารวม
             $totalPrice=$totalPrice+$item['totalSinglePrice'];//ราคารวมของสินค้าแต่ละรายการ

         }
         $this->totalQuantity=$totalQuantity;
         $this->totalPrice=$totalPrice;
    }
}



    //ราคาสินค้า * จำนวนสินค้า = จำนวนราคารวม  ex. รองเท้า 2 * 1,500=3,000 และ ทีวี 2 * 5,000=10,000

    //จำนวนราคารวม = ราคาสินค้า + จำนวนสินค้าที่ซื้อ
    // 13,000

    //$totalQuantity 2+2=4

?>





