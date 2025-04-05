<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    // パスワードリセットフォームを表示するメソッド
    public function showResetForm(Request $request)
    {
        // もともとの暗号化トークンをそのまま使って検索
        $token = $request->token;

        // トークンをデータベースで検索
        $passwordReset = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();

        // トークンが存在し、有効期限内であることを確認
        if ($passwordReset && Carbon::parse($passwordReset->created_at)->addHours(1)->isFuture()) {
            // トークンが有効であればリセットフォームを表示
            return view('auth.passwords.reset', [
                'token' => $request->token,
                'email' => $passwordReset->email,
            ]);
        }

        // トークンが無効の場合、ログインページにリダイレクト
        return redirect()->route('login')->withErrors(['message' => '無効なトークンです。']);
    }

    // パスワードリセット処理を行うメソッド
    public function reset(Request $request)
    {
        // リクエストのバリデーション（メールアドレス、パスワード、トークン）
        $request->validate([
            'email' => 'required|email',  // メールアドレスは必須で、正しい形式であること
            'password' => 'required|confirmed|min:8',  // パスワードは必須で、確認用フィールドとの一致と最小8文字が必要
            'token' => 'required',  // トークンは必須
        ]);

        // メールアドレスに該当するユーザーを検索
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // トークンをデータベースで検索
            $passwordReset = DB::table('password_reset_tokens')
                ->where('token', $request->token)
                ->where('email', $request->email)  // メールアドレスも確認
                ->first();

            // トークンが存在し、有効期限内であることを確認
            if ($passwordReset && Carbon::parse($passwordReset->created_at)->addHours(1)->isFuture()) {
                // 新しいパスワードをハッシュ化して保存
                $user->password = Hash::make($request->password);
                $user->save();

                // パスワードリセット後にユーザーをログインさせる
                Auth::login($user);

                // 使用されたトークンを削除（再使用防止）
                DB::table('password_reset_tokens')
                    ->where('email', $request->email)
                    ->where('token', $request->token)
                    ->delete();

                // パスワードリセット後、ダッシュボードページにリダイレクト
                return redirect()->route('lendings.index');  // 例: ダッシュボードページにリダイレクト
            } else {
                // トークンが無効または期限切れの場合、エラーメッセージを表示
                return redirect()->route('login')->withErrors(['message' => '無効なトークンです。']);
            }
        } else {
            // ユーザーが見つからない場合のエラーメッセージ
            return redirect()->route('login')->withErrors(['email' => '指定されたメールアドレスのユーザーは存在しません。']);
        }
    }
}
