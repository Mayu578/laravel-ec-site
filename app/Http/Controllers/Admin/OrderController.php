<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    // 注文一覧

    public function index()
    {
        $orders = Order::with([
            'user',
            'orderItems.product'
        ])
            ->latest()
            ->paginate(10);

        return view('admin.orders.index', compact('orders'));
    }


    // 注文詳細
    public function show(Order $order)
    {
        $order->load('user', 'orderItems.product');

        return view('admin.orders.show', compact('order'));
    }
}
