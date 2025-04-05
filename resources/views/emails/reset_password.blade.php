<!-- resources/views/emails/reset_password.blade.php -->
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>パスワードリセットリンク</title>
</head>

<body>
    <p>こんにちは。</p>
    <p>以下のリンクから24時間以内にパスワードを再設定してください。</p>

    <p>
        <a href="{{ $resetLink }}">{{ $resetLink }}</a>
    </p>

    <p style="color: #dc3545; font-weight: bold;">※リンクの有効期限は24時間です。</p>

    <!-- <p>※署名付きURLの生成に失敗した時は以下のリンク</p>
    <a href="{{ $resetLink }}">パスワードリセット</a> -->

    <p>もしこのリクエストに心当たりがない場合は、何もせずにこのメールを無視してください。</p>
    <p>ありがとうございます。</p>
</body>

</html>