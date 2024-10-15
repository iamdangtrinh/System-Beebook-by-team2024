<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Include thêm CSS và các thư viện cần thiết ở đây -->
</head>
<body>
    <!-- Include Header -->
    @include('client.layouts.header')

    <div class="container">
        <!-- Nội dung chính -->
        @yield('content')
    </div>

    <!-- Include Footer -->
    @include('client.layouts.footer')

    <!-- Include thêm JS nếu cần -->
</body>
</html>