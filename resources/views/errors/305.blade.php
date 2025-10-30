<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $exception->getStatusCode() }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="m-0 min-h-screen bg-center bg-cover bg-fixed flex items-center justify-center"
      style="background-image: url('https://http.cat/{{ $exception->getStatusCode() }}'); background-repeat: no-repeat; background-size: cover; background-position: center center; background-attachment: fixed;">
<div class="text-white text-4xl font-bold text-center px-6 py-4 rounded-lg"
     style="text-shadow: 2px 2px 4px rgba(0,0,0,1);">
    <h2>{{ $exception->getMessage() }}</h2>
</div>
</body>
</html>
