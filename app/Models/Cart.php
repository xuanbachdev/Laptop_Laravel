<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Cart extends Model
{
    use HasFactory;
    public $products = null;
    public $totalPrice = 0;
    public $totalQuanty = 0;

    public function __construct($cart)
    {
        if ($cart) {
            $this->products = $cart->products;
            $this->totalPrice = $cart->totalPrice;
            $this->totalQuanty = $cart->totalQuanty;
        }
    }

    public function AddCart($product, $id)
    {
        $session_id = substr(md5(microtime()) . rand(0, 26), 5);
        $price = $product->price;
        if($product->sale_price){
            $price = $price * (100 - $product->sale_price) / 100;
        }
        $newProduct = ['product_id' => $product->id, 'product_in_stock' => $product->quantity,'session_id' => $session_id, 'quanty' => 0, 'price' => $price, 'productInfo' => $product];
        if ($this->products) {
            if (array_key_exists($id, $this->products)) {
                $newProduct = $this->products[$id];
            }
        }
        $newProduct['quanty']++;
//        $newProduct['price'] = $price;
        $this->products[$id] = $newProduct;
        $this->totalPrice +=  $price;
        $this->totalQuanty++;
    }

    public function DeleteItemCart($id)
    {
        $this->totalQuanty -= $this->products[$id]['quanty'];
        $this->totalPrice -= $this->products[$id]['price'];
        unset($this->products[$id]);
    }


    public function UpdateItemCart($id, $quanty)
    {
        $this->totalQuanty-=$this->products[$id]['quanty'];
        $this->totalPrice-=$this->products[$id]['price'];

        $this->products[$id]['quanty']= $quanty;
        $this->products[$id]['price']=  $this->products[$id]['price'];

        $this->totalQuanty+=$this->products[$id]['quanty'];
        $this->totalPrice+=$this->products[$id]['price'];
    }

}
