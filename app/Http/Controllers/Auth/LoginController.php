<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

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
        // ログイン試行のキーを作成
        // ここでは、ユーザーのメールアドレスとIPアドレスを組み合わせて、個別のログイン試行回数を追跡
        // メールアドレスは小文字に変換して一貫性を持たせ、同じメールアドレスでの大文字小文字の違いを避ける
        $key = 'login-attempt:' . Str::lower($request->input('email')) . '|' . $request->ip();

        // $key = 'login-attempt:' . $request->ip(); // IPアドレス単位で制限

        // ログイン試行回数の制限を確認する
        if (RateLimiter::tooManyAttempts($key, 5)) {
            // 制限に達した場合、次にログイン試行できるまでの時間（秒）を取得
            $seconds = RateLimiter::availableIn($key);

            // 制限に達した場合、エラーメッセージを表示して、再試行までの時間を伝える
            return back()->withErrors([
                'email' => "ログイン試行が多すぎます。{$seconds}秒後に再試行してください。",
            ]);
        }


        // 試行回数をインクリメント
        RateLimiter::hit($key, 60); // 60秒間有効

        // 1. リクエストのデータを検証する
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. 認証を試みる
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            RateLimiter::clear($key); // 成功時は試行回数リセット

            // 認証に成功したら、セッションを再生成する
            $request->session()->regenerate();

            // ダッシュボードにリダイレクトする
            return redirect()->intended('lendings');
        }

        // 認証に失敗した場合は、ログインページにリダイレクトする
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->onlyInput('email');
    }
}
