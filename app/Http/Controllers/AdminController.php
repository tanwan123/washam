<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function orders()
    {
        $orders = Order::all();
        return view('admin.orders', compact('orders'));
    }

    public function services()
    {
        $services = Service::all();
        return view('admin.services', compact('services'));
    }
    public function customers()
    {
        $customers = User::all();
        return view('admin.customers', compact('customers'));
    }
    public function settings()
    {
        return view('admin.settings');
    }
    public function assignCollectorForm(Order $order)
    {
        $collectors = User::where('role', 'collector')->get();
        return view('admin.assign_collector', compact('order', 'collectors'));
    }

    public function assignCollector(Request $request, Order $order)
    {
        $request->validate(['collector_id' => 'nullable|exists:users,id']);
        $order->collector_id = $request->collector_id;
        $order->status = $request->collector_id ? 'assigned' : $order->status;
        $order->save();

        return redirect()->route('admin.orders')->with('success', 'Collector assigned.');
    }
}
