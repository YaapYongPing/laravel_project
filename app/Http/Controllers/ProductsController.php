<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;

class ProductsController extends Controller
{
     public function createProduct(Request $request){
        $incomingFields = $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'product_price' => 'required',
            'product_quantity' => 'required'
        ]);
        $incomingFields['user_id'] = auth()->user()->id;
        $product = Product::create($incomingFields);

        session()->flash('success_message', 'Product added successfully');
        
        return redirect('/home');
     }

public function addToCart(Request $request){
    $incomingFields = $request->validate([
        'product_id' => 'required',
        'cart_quantity' => 'required'
    ]);

    $user_id = auth()->user()->id;

    $existingCartItem = Cart::where('user_id', $user_id)
                         ->where('product_id', $incomingFields['product_id'])
                         ->first();

    $product = Product::find($incomingFields['product_id']);
    $product->product_quantity -= $incomingFields['cart_quantity'];
    $product->save();

    if ($existingCartItem) {
        $existingCartItem->cart_quantity += $incomingFields['cart_quantity'];
        $existingCartItem->save();
    } else {
        $cartItem = new Cart([
            'product_id' => $product->product_id,
            'cart_quantity' => $incomingFields['cart_quantity'],
            'user_id' => $user_id,
            ]);
        $cartItem->save();
    }

    session()->flash('success_message', 'Item added to cart');

    return redirect('/home');
}


}
