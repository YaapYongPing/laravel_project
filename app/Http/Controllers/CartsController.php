<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartsController extends Controller
{
    public function modifyQuantity(Request $request){

    $incomingFields = $request->validate([
        'cart_id' => 'required',
        'product_id' => 'required',
    ]);

    $existingCartItem = Cart::where('id', $incomingFields['cart_id'])->first();
    $existingProduct = Product::where('product_id', $incomingFields['product_id'])->first();

    if($existingCartItem && $existingProduct) {
            $existingCartItem->cart_quantity -= 1;
            $existingCartItem->save();

            $existingProduct->product_quantity += 1;
            $existingProduct->save();

            if($existingCartItem->cart_quantity == 0) {
                $existingCartItem->delete();
            }

            session()->flash('success_message', 'Item removed by 1 from cart');
    } 
        return redirect('/cart');
    }

    public function deleteItem(Request $request){
        $incomingFields = $request->validate([
            'cart_id' => 'required',
            'product_id' => 'required'
        ]);

        $existingCartItem = Cart::where('id', $incomingFields['cart_id'])->first();
        $existingProduct = Product::where('product_id', $incomingFields['product_id'])->first();

        if($existingCartItem && $existingProduct) {
            $existingProduct->product_quantity += $existingCartItem->cart_quantity;
            $existingProduct->save();
            $existingCartItem->delete();
            session()->flash('success_message', 'Item deleted from cart');
        } else {
            return redirect('/cart');
        }
        return redirect('/cart');
    }

}
