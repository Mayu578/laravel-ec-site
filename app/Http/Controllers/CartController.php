<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{


    // Display cart page
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();
        return view('cart.index', compact('cartItems'));
    }

    // Add products to cart


    public function add(Request $request, Product $product)
    {

        if ($product->quantity <= 0) {
            return back()->withErrors('在庫切れのためカートに追加できません');
        }

        // Quantity Validation
        $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . $product->quantity,
            ],
        ]);

        $addQuantity = (int) $request->quantity;

        $cart = Cart::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ],
            [
                'quantity' => 0,
            ]
        );


        if ($cart->quantity + $addQuantity > $product->quantity) {
            return back()->withErrors('在庫数を超えています');
        }

        $cart->increment('quantity', $addQuantity);

        return back()->with('success', 'Added to cart!');
    }



    // Update quantity of product
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . $cart->product->quantity, // ← Check product inventory
            ],
        ]);

        $cart->update([
            'quantity' => $request->quantity,
        ]);

        return back()->with('success', 'Cart updated!');
    }

    // Remove from the cart
    public function remove(Cart $cart)
    {
        // Verify your cart (Security)
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cart->delete();

        return back()->with('success', 'Removed from cart!');
    }
}
