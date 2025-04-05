<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class CustomResetPassword extends ResetPasswordNotification
{
    use Queueable;

    public $token;

    /**
     * Create a new notification instance.
     *
     * @param string $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the mail message for the reset password.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // トークンが正しく渡されているか確認するために dd()
        //   dd($this->token);  // ここでトークンが表示されます
        $url = url(route('password.reset', [
            // パスワードリセットのURLを生成するためのルート名を指定
            // 'token' => $this->token,  // パスワードリセットに必要なトークン（ユニークな識別子）
            'token' => encrypt($this->token), // 暗号化してURLに渡す
            'email' => $notifiable->getEmailForPasswordReset(),  // リセット対象のユーザーのメールアドレス
        ], false));  // 'false' は絶対URLを生成することを指定（省略時は、相対URLになることもある）

        return (new MailMessage)
            ->subject('パスワードリセットのお知らせ')
            ->greeting('こんにちは！')
            ->line('パスワードリセットのリクエストを受け付けました。')
            ->action('パスワードをリセット', $url)
            ->line('このリンクは60分後に期限切れになります。')
            ->line('リセットのリクエストを行っていない場合は、何も操作する必要はありません。')
            ->salutation('よろしくお願いします。')
            ->line('Laravelより')
            ->line('もし「パスワードをリセット」ボタンがクリックできない場合は、以下のURLをコピーしてブラウザに貼り付けてください：')
            ->line($url);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
