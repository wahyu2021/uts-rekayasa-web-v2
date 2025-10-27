<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['user', 'orderItems'])->latest()->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|string|in:pending,paid,failed',
            'tracking_number' => 'nullable|string|max:255',
            'shipping_status' => 'nullable|string|in:pending,processing,shipped,delivered,cancelled',
            'tracking_history.location' => 'nullable|string|max:255',
            'tracking_history.status' => 'nullable|string|max:255',
            'tracking_history.description' => 'nullable|string|max:255',
        ]);

        $order->update([
            'status' => $request->status,
            'tracking_number' => $request->tracking_number,
            'shipping_status' => $request->shipping_status,
        ]);

        if ($request->filled('tracking_history.location') && $request->filled('tracking_history.status')) {
            $history = $order->tracking_history ?? [];
            $history[] = [
                'timestamp' => now(),
                'location' => $request->input('tracking_history.location'),
                'status' => $request->input('tracking_history.status'),
                'description' => $request->input('tracking_history.description'),
            ];
            $order->update(['tracking_history' => $history]);
        }

        return redirect()->route('admin.orders.edit', $order)->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
