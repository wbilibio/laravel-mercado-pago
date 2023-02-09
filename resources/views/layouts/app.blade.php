<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>App Mercado Pago - @yield('title')</title>

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @livewireStyles
    </head>
    <body>
        @yield('content')

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">© 2017–2023 PerfectPay</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacidade</a></li>
                <li class="list-inline-item"><a href="#">Termos</a></li>
                <li class="list-inline-item"><a href="#">Suporte</a></li>
            </ul>
        </footer>
        @livewireScripts
        @stack('scripts')
    </body>
</html>
