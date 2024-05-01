<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Compartiendo historias')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>

    @include('components.header')

    <main>
        {{ $slot }}
    </main>

</body>

</html>
