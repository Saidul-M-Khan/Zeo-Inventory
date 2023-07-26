<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="referrer" content="always" />
        <script src="{{ asset('/js/axios.min.js') }}"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script
            defer
            src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
        ></script>
        <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/toastify.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet" />
        <link
            href="{{ asset('css/datatables-select.min.css') }}"
            rel="stylesheet"
        />

        <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/toastify-js.js')}}"></script>
    <script src="{{asset('js/axios.min.js')}}"></script>
    <script src="{{asset('js/config.js')}}"></script>
    <script src="{{asset('js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('js/datatables.min.js')}}"></script>
    <script src="{{asset('js/datatables-select.min.js')}}"></script>
    </head>
    <body>
        @include('components.loader')
        <div
            x-data="{ sidebarOpen: false }"
            class="flex h-screen bg-gray-200 font-roboto"
        >
            @include('components.dashboard.sidebar')

            <div class="flex-1 flex flex-col overflow-hidden">
                @include('components.dashboard.header')

                <main
                    class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200"
                >
                    <div class="container mx-auto px-6 py-8">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
