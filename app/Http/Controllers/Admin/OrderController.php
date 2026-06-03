<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);

        return view('admin.orders.show', compact('order'));
    }
    public function toggleStatus(Order $order)
    {
        $order->status = $order->status === 'processing'
            ? 'done'
            : 'processing';

        $order->save();

        return back()->with('success', 'Order status updated.');
    }
}