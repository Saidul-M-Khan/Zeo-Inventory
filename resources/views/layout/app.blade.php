<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>ZEO INVENTORY</title>
        <script src="{{ asset('/js/axios.min.js') }}"></script>
        <script src="https://cdn.tailwindcss.com"></script>

        <link
            rel="icon"
            type="image/x-icon"
            href="{{ asset('/favicon.ico') }}"
        />
        <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/toastify.min.css') }}" rel="stylesheet" />
        <script src="{{ asset('js/toastify-js.js') }}"></script>
        <script src="{{ asset('js/config.js') }}"></script>

        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body>
        @include('components.loader')
        @yield('content')
    </body>
</html>
