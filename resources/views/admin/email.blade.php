<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
</head>
<body>
    <h2>Xin chào {{ $user->name ?? 'bạn' }},</h2>

    <p>{{ $body }}</p>

    <p>Xem chi tiết tại: <a href="{{ $url }}">{{ $url }}</a></p>
</body>
</html>
