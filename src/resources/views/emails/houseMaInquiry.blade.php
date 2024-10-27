<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>M&A物件お問い合わせ</title>
</head>
<body>
    <h1>M&A物件に関するお問い合わせ</h1>

    <h2>お問い合わせ内容</h2>
    <p>以下の内容でお問い合わせがありました。</p>

    <h3>問い合わせた人</h3>
    <p><strong>メールアドレス:</strong> {{ $email }}</p>
    <p><strong>お名前:</strong> {{ $name }}</p>

    <h3>物件情報</h3>
    <p><strong>案件名:</strong> {{ $property->name }}</p>
    <p><strong>物件URL:</strong> <a href="{{ route("web.ma_search.show", $property->id) }}">{{ route("web.ma_search.show", $property->id) }}</a></p>

    <h3>お問い合わせ内容</h3>
    <p><strong>お問い合わせ種類:</strong> {{ $inquiryType }}</p>
    <p><strong>メッセージ:</strong></p>
    <p>{{ $messageText }}</p>

</body>
</html>
