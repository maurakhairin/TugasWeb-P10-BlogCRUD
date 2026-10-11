<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Blog CRUD Laravel')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <header class="site-header">
        <div class="container">
            <a href="{{ route('posts.index') }}" class="brand">Blog CRUD</a>
        </div>
    </header>

    <main>
        <div class="container">

            <x-alert type="success" :message="session('success')" />
            <x-alert type="danger" :message="session('error')" />

            @yield('content')

        </div>
    </main>

</body>
</html>