<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Explorer - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans">
    @include('components.Userheader')

    <main class="container mx-auto px-4 py-8 min-h-screen">
        @yield('content')
    </main>

    @include('components.footer')
</body>
</html>
