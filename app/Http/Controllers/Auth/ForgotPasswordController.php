<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use App\Models\User; // Userモデルをインポート
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\URL;

class ForgotPasswordController extends Controller
{
    // パスワードリセットリンクを送信するフォームを表示するメソッド
    public function showLinkRequestForm()
    {
        // パスワードリセットメール送信フォームのビューを返す
        return view('auth.passwords.email');  // パスワードリセットメール送信フォームのビュー
    }

    // パスワードリセットリンクを送信する処理
    public function sendResetLinkEmail(Request $request)
    {
        // リクエストのバリデーション（メールアドレスが正しい形式であること）
        $request->validate([
            'email' => 'required|email',  // メールアドレスは必須で、正しい形式であること
        ]);

        // メールアドレスでユーザーをデータベースから検索
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // 60文字のランダムなトークンを生成
            $token = Str::random(60);

            // トークンを暗号化して保存（セキュリティ向上のため、暗号化してDBに保存）
            // $encryptedToken = Crypt::encrypt($token);// DB保存用 & URL用に共通

            // すでに存在するリセットトークンを削除
            DB::table('password_reset_tokens')->where('email', $user->email)->delete();

            // 暗号化したトークンと共に、メールアドレスと作成日時をデータベースに保存
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => now(),
            ]);

            // パスワードリセット用のURLを生成
            // 生成されたトークンをURLのパラメータとして設定
            // $resetLink = url(route('password.reset', ['token' => $token]));
            // 署名付きのパスワードリセットURLを生成（24時間有効）
            $resetLink = URL::temporarySignedRoute(
                'password.reset', // ←ルート名
                now()->addHours(24), // 有効期限
                ['token' => $token]
            );

            // リセットメールを送信
            Mail::to($user->email)->send(new ResetPasswordMail($resetLink));
            // パスワードリセットリンクをメールで送信（Laravelが提供するPassword::sendResetLinkメソッドを利用）
            // Password::sendResetLink(['email' => $user->email]);

            // リセットリンク送信が成功した旨のメッセージを返す
            return back()->with('status', 'リセットリンクを送信しました。');
        }

        // メールアドレスが見つからない場合、エラーメッセージを返す
        // ユーザーが存在しない場合や、メールアドレスが登録されていない場合に表示
        return back()->withErrors(['email' => 'メールアドレスが見つかりませんでした。']);
    }
}
