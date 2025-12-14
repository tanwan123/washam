<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Order::with('user')->orderBy('created_at', 'desc')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'pickup_address' => 'required|string',
            'delivery_address' => 'nullable|string',
            'service_type' => 'required|in:wash,wash_and_fold,dry_clean',
            'items_count' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);


        $order = Order::create($data);
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Order::with('user')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $data = $request->validate([
            'status' => 'sometimes|in:pending,in_progress,completed,cancelled',
            'price' => 'sometimes|numeric|min:0',
            'delivery_date' => 'sometimes|date',
        ]);
        $order->update($data);
        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Order::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
