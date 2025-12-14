<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\middleware;


class CollectorController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','collector']);
    }

    // dashboard - show assigned orders and their statuses
    public function index()
    {
        $orders = Order::where('collector_id', Auth::id())->latest()->get();
        return view('collector.dashboard', compact('orders'));
    }

    // mark picked up
    public function markPickedUp(Order $order)
    {
        // ensure authorized collector
        if ($order->collector_id !== Auth::id()) abort(403);
        $order->update(['status' => 'collected']);
        return response()->json(['success'=>true,'status'=>'collected']);
    }

    // mark delivered
    public function markDelivered(Order $order)
    {
        if ($order->collector_id !== Auth::id()) abort(403);
        $order->update(['status' => 'delivered']);
        return response()->json(['success'=>true,'status'=>'delivered']);
    }
}
