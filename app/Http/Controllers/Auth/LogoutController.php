<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * ログアウト処理を実行する
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // 1. ユーザーをログアウトさせる
        Auth::logout();

        // 2. セッションを無効にする
        $request->session()->invalidate();

        // 3. 新しいCSRFトークンを再生成する
        $request->session()->regenerateToken();

        // 4. トップページにリダイレクトする
        return redirect('/');
    }
}
