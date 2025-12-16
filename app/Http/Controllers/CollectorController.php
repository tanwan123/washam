<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\middleware;


class CollectorController extends Controller
{
 public function pickups()
    {
        $orders = Order::where('status','pending')
            ->with('user','items')
            ->get();

        return view('collector.pickups', compact('orders'));
    }

    // dashboard - show assigned orders and their statuses
    public function orders()
    {
        // Fetch all assigned orders for the authenticated collector
        $assignedOrders = Order::where('collector_id', Auth::id())
            ->where('status', 'Pending') // Adjust this filter as necessary
            ->get();

        return view('collector.orders', compact('assignedOrders')); // Pass it to the view
    }
    public function completedOrders()
    {
        $completedOrders = Order::where('collector_id', Auth::id())
            ->where('status', 'Completed') // Adjust this as per your completed status
            ->latest()
            ->get();

        return view('collector.completed', compact('completedOrders'));
    }

    public function index()
    {
        $collectorId = auth()->id();

        $assignedOrders = Order::where('collector_id', $collectorId)->get();
        $pickedOrders   = Order::where('collector_id', $collectorId)->where('status', 'Picked Up')->get();
        $deliveredOrders = Order::where('collector_id', $collectorId)->where('status', 'Delivered')->get();

        return view('collector.dashboard', compact(
            'assignedOrders',
            'pickedOrders',
            'deliveredOrders'
        ));
    }

    // mark delivered
    public function markDelivered(Order $order)
    {
        if ($order->collector_id !== Auth::id()) abort(403);
        $order->update(['status' => 'delivered']);
        return response()->json(['success' => true, 'status' => 'delivered']);
    }
}
