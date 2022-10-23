<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Cart; 

class CartController extends Controller
{
    //

    // save_cart
    public function save_cart(Request $request) {
        $id = $request-> id;
        $quantity = $request-> quantity;

      
        $db = new Product();
        $product = $db-> getProduct($id);
        $data['id'] = $product->id;
        $data['name'] = $product->name; 
        $data['qty'] = $quantity;
        $data['price'] = $product->price;
        $data['weight'] = 550;
        $data['options']['size'] = 'large';
        $data['options']['image'] = $product->image;  
        Cart::add($data);
        Cart::setGlobalTax(0);
      
       
        return redirect() -> route('cart.show');

    }

    public function show_cart() {

        return view('pages.cart.show_cart');
    }

    // remove cart
    public function remove_cart($id) {
        Cart::remove($id);
        return redirect() -> route('cart.show');
    }

    public function update_cart(Request $request) {
        $rowId = $request-> rowId;
        $qty = $request-> quantity;
        Cart::update($rowId, $qty);
        return redirect() -> route('cart.show');
        
    }
}
