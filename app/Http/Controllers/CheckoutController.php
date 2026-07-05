<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    public function show($id)
    {
        $order = Order::with('orderItems.product')->findOrFail($id);

        return view('orders.show', compact('order'));
    }
    // Display Checkout page
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    // Purchase Confirmed (Dummy)


    public function confirm(Request $request)
    {
        $userId = Auth::user()->id;

        DB::beginTransaction();

        try {
            $cartItems = Cart::with('product')
                ->where('user_id', $userId)
                ->lockForUpdate()
                ->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception('カートが空です');
            }

            // ① 在庫チェック
            foreach ($cartItems as $item) {
                if ($item->quantity < 1) {
                    throw new \Exception('数量が不正です');
                }

                $product = $item->product;

                if ($item->quantity > $product->quantity) {
                    throw new \Exception($product->name . ' の在庫が不足しています');
                }
            }

            // ② Order 作成
            $order = Order::create([
                'user_id' => $userId,
                'total_price' => $cartItems->sum(
                    fn($item) => $item->product->price * $item->quantity
                ),
                'status' => 'pending',
            ]);

            // ③ OrderItem 作成 ＋ 在庫減算
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product->id,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ]);

                $item->product->decrement('quantity', $item->quantity);
            }

            // ④ カート削除
            Cart::where('user_id', $userId)->delete();

            DB::commit();

            return redirect()->route('checkout.complete', $order)
                ->with('success', '購入が完了しました！');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function complete(Order $order)
    {
        // Only your own orders can be viewed.
        abort_if($order->user_id !== Auth::id(), 403);
        
        return view('checkout.complete', compact('order'));
    }
}
