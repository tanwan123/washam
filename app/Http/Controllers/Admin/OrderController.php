<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
  public function index()
{
    $orders = Order::with('customer', 'items', 'collector')
        ->latest()
        ->get();

    return view('admin.orders', compact('orders'));
}

    public function assignCollector(Request $request, Order $order)
    {
        $request->validate([
            'collector_id' => 'required|exists:users,id',
        ]);

        $order->update([
            'collector_id' => $request->collector_id,
            'status' => 'assigned',
        ]);

        return redirect()->back()->with('success', 'Collector assigned successfully.');
    }
}
