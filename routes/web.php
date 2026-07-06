<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SectionController as AdminSectionController;

//デバック用
Route::get('/debug-user/{email}', function ($email) {
    $user = \App\Models\User::where('email', $email)->first();
    if (!$user) {
        return 'ユーザーが見つかりません';
    }
    return [
        'name' => $user->name,
        'email' => $user->email,
        'is_admin' => $user->is_admin,
    ];
});


// トップページは /dashboard にリダイレクト
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// ダッシュボード表示用
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');



// 商品一覧ページ
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
//categoryごと
Route::get('/category/{category}', [ProductController::class, 'category'])
    ->name('products.category');

// routes/web.php
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');




//Cart

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');

    // チェックアウト

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/confirm', [CheckoutController::class, 'confirm'])->name('checkout.confirm');
    Route::get('/checkout/complete/{order}', [CheckoutController::class, 'complete'])->name('checkout.complete');
});




Route::middleware(['auth', 'not_admin'])->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index'])
        ->name('favorites.index');

    //favorite button
    Route::post('/products/{product}/favorite', [FavoriteController::class, 'toggle'])
        ->name('products.favorite');


    Route::get('/orders', [DashboardController::class, 'orders'])
        ->name('orders.index');
});





require __DIR__ . '/auth.php';

// =======================
//   Admin Routes
// =======================


Route::middleware(['auth', 'verified', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    // セクション追加
    Route::get('sections/create', [AdminSectionController::class, 'create'])->name('sections.create');
    Route::post('sections', [AdminSectionController::class, 'store'])->name('sections.store');
    Route::get('sections', [AdminSectionController::class, 'index'])->name('sections.index');
    Route::delete('sections/{section}', [AdminSectionController::class, 'destroy'])->name('sections.destroy');

    // 注文管理
    Route::get('orders', [AdminOrderController::class, 'index'])
        ->name('orders.index');

    Route::get('orders/{order}', [AdminOrderController::class, 'show'])
        ->name('orders.show');

    //User
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('users/{user}', [AdminUserController::class, 'show'])->name('users.show');
});

Route::get('/gd-check', function () {
    return [
        'gd_loaded' => extension_loaded('gd'),
        'gd_info'   => function_exists('gd_info'),
        'php_ini'   => php_ini_loaded_file(),
    ];
});
