<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Chương trình mới</title>
</head>
<body>
    <h1>Chương trình mới!</h1>
    <p>Xin chào {{ $user->name }}, chúng tôi vừa ra mắt chương trình khuyến mãi mới.</p>
    <a href="{{ url('/programs') }}">Xem chi tiết tại đây</a>
</body>
</html>
