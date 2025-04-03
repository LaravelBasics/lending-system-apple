<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * ログインフォームを表示する
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * ユーザーのログイン処理を実行する
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // 1. リクエストのデータを検証する
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. 認証を試みる
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            // 認証に成功したら、セッションを再生成する
            $request->session()->regenerate();

            // ダッシュボードにリダイレクトする
            return redirect()->intended('lendings');
        }

        // 認証に失敗した場合は、ログインページにリダイレクトする
        return back()->withErrors([
            'email' => 'ログイン情報が正しくありません。',
        ])->onlyInput('email');
    }
}
