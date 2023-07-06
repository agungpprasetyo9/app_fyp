<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title') - FYP</title>

</head>
<body class="overflow-hidden">
<!-- Navbar -->
<nav class="bg-gray-800 py-4">
    <div class="container mx-auto flex items-center justify-between">
        <a href="#" class="flex items-center text-white text-xl font-bold">
            <img src="{{ asset('images/logo.png')}}" alt="Logo" class="h-8 mr-2">
            Find Your Path
        </a>
        <ul class="flex space-x-4">
            <li><a href="#" class="text-white">Home</a></li>
            <li><a href="#" class="text-white">About</a></li>
            <li><a href="{{ route('register') }}" class="text-white">Sign Up</a></li>
            <li><a href="{{ route('login') }}" class="text-white">Login</a></li>
        </ul>
    </div>
</nav>

<!-- Content -->

@yield('container')


</body>
</html>