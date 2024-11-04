<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Taskable')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-200 min-h-screen">
    <header>
        <!-- Header content -->
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p class="text-center">Copyright &copy; 2024. Solomon Akpuru</p>
    </footer>


</body>
</html>
