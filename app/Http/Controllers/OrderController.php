<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    /**
     * Show pickup request form
     */
    public function create()
    {
        return view('orders.request-pickup');
    }

    /**
     * Show logged-in user's requests
     */
    public function myRequests()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.my-requests', compact('orders'));
    }

    /**
     * Store pickup request
     */
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|numeric',
            'items.*.quantity' => 'required|integer',
            'total' => 'required|numeric',
            'pickup_address' => 'required|string',
            'delivery_address' => 'nullable|string',
            'contact_phone' => 'required|string',
        ]);

        $order = Order::create([
            'user_id' => Auth::id(),
            'pickup_address' => $request->pickup_address,
            'delivery_address' => $request->delivery_address,
            'contact_phone' => $request->contact_phone,
            'total' => $request->total,
            'status' => 'Pending',
        ]);

        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
