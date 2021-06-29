<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/css/app.css') }}">
    <title>@yield('title')</title>
    <script type="application/javascript" src="{{ asset('public/js/app.js') }}" defer></script>
</head>
<body>
    @yield('content')
</body>
</html>