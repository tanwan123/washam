<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    
    public function add(Request $request)
    {
        $request->validate([
            'service_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric|min:1'
        ]);

        $cart = session()->get('cart', []);
        $id = $request->service_id;

        if(isset($cart[$id])){
            $cart[$id]['quantity'] += $request->quantity;
        } else {
            $cart[$id] = [
                'service_id' => $id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => $request->quantity
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success'=>true,'message'=>'Service added to cart.']);
    }
}
