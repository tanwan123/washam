<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

     public function index()
    {
        $orders = Order::with('items','user')
            ->latest()
            ->get();

        return view('admin.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user','items');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status'=>'required|string']);
        $order->update(['status'=>$request->status]);
        return redirect()->back()->with('success','Status updated');
    }
}
