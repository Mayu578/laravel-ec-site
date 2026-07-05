<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    // ログイン画面を表示
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // ログイン処理
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // adminガードでログイン試行
        if (Auth::guard('admin')->attempt($credentials)) {

            // ログイン成功後にadminダッシュへ
            return redirect()->route('admin.dashboard');
        }

        // ログイン失敗
        return back()->withErrors([
            'email' => 'ログイン情報が正しくありません。',
        ]);
    }

    // ログアウト
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

