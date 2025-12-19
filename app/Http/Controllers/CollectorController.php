<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CollectorController extends Controller
{
    // Show all pickups with 'pending' status
    public function pickups()
    {
        $orders = Order::where('status', 'pending')
            ->with('user', 'items') // Eager load user and items relationships
            ->get();

        return view('collector.pickups', compact('orders'));
    }

    // Show assigned orders and their statuses
    public function orders()
    {
        // Fetch all assigned orders for the authenticated collector
        $assignedOrders = Order::where('collector_id', Auth::id())
            ->whereIn('status', ['assigned', 'pending']) // Include both 'assigned' and 'pending'
            ->with('user', 'items') // Eager load relationships
            ->get();

        return view('collector.orders', compact('assignedOrders')); // Pass assigned orders to the view
    }

    // Show completed orders
    public function completedOrders()
    {
        $completedOrders = Order::where('collector_id', Auth::id())
            ->where('status', 'completed') // Filter for completed orders
            ->latest() // Order by latest first
            ->with('user', 'items') // Eager load relationships
            ->get();

        return view('collector.completed', compact('completedOrders')); // Pass completed orders to the view
    }

    // Dashboard for the collector
    public function index()
    {
        $collectorId = auth()->id();

        // Fetch different types of orders for the collector
        $assignedOrders = Order::where('collector_id', $collectorId)
            ->whereIn('status', ['assigned', 'pending']) // Fetch assigned and pending orders
            ->with('user', 'items') // Eager load relationships
            ->get();

        $pickedOrders = Order::where('collector_id', $collectorId)
            ->where('status', 'picked-up') // Fetch picked up orders
            ->with('user', 'items') // Eager load relationships
            ->get();

        $deliveredOrders = Order::where('collector_id', $collectorId)
            ->where('status', 'delivered') // Fetch delivered orders
            ->with('user', 'items') // Eager load relationships
            ->get();

        return view('collector.dashboard', compact(
            'assignedOrders',
            'pickedOrders',
            'deliveredOrders'
        )); // Pass all order types to the dashboard view
    }

    // Mark an order as delivered
    public function markDelivered(Order $order)
    {
        // Ensure the authenticated collector is assigned to the order
        if ($order->collector_id !== Auth::id()) {
            abort(403); // Unauthorized access
        }

        // Update the order status to 'delivered'
        $order->update(['status' => 'delivered']);

        return response()->json(['success' => true, 'status' => 'delivered']); // Return success response
    }

    // (NEW) Show requests assigned to the collector
    public function myRequests()
    {
        $orders = Order::where('collector_id', Auth::id())
            ->whereIn('status', ['assigned', 'pending']) // Fetch orders assigned to the collector
            ->with('user', 'items') // Eager load relationships
            ->get();

        return view('collector.my_requests', compact('orders')); // Pass to the view
    }
}