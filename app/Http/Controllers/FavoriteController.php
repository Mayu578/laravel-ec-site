<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class FavoriteController extends Controller
   {
    public function toggle(Product $product)
    {
        /** @var User $user */
        $user = Auth::user();

        $user->favorites()->toggle($product->id);

        return back();
    }

    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $favorites = $user->favorites()
            ->with('section')
            ->get();

        return view('favorites.index', compact('favorites'));
    }
}

