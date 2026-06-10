<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class DashboardController extends Controller
{
    public function orders()
    {
        $userId = Auth::user()->id;
        $orders = Order::with('orderItems.product')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }



    public function dashboard()
    {
        // すべての商品
        $allProducts = Product::latest()->get();

        // Furniture（take(7)を外して全件にする）
        $furnitureProducts = Product::whereHas('section', function ($q) {
            $q->where('category', 'furniture');
        })->latest()->get();

        // Lifestyle（take(7)を外して全件にする）
        $lifestyleProducts = Product::whereHas('section', function ($q) {
            $q->where('category', 'lifestyle');
        })->latest()->get();

        return view('dashboard', compact(
            'allProducts',
            'furnitureProducts',
            'lifestyleProducts'
        ));
    }
}
