<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function storePickup(Request $request)
    {
        $request->validate([
            'pickup_address'   => 'required|string',
            'contact_phone'    => 'required|string',
            'items'            => 'required|array|min:1',
            'total'            => 'required|numeric|min:1',
        ]);

        // Create order
        $order = Order::create([
            'user_id'         => Auth::id(),
            'pickup_address'  => $request->pickup_address,
            'delivery_address' => $request->delivery_address,
            'contact_phone'   => $request->contact_phone,
            'total'           => $request->total,
            'status'          => 'pending',
        ]);

        // Save order items
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'service_name' => $item['name'],
                'quantity'     => $item['qty'],
                'price'        => $item['total'],
            ]);
        }
        return response()->json([
            'success' => true,
            'order_id' => $order->id,
        ]);
    }
    public function pickupForm()
    {
        return view('orders.request-pickup');
    }

    public function myOrders()
    {
        $orders = Order::with('items', 'collector')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.my-orders', compact('orders'));
    }
    public function myRequests()
    {
        $orders = Order::with('user_id', Auth::id())
            ->with('items', 'collector')
            ->latest()
            ->get();

        return view('orders.my-requests', compact('orders'));
    }
}
