<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/favicon.ico') }}" type="image/x-icon">

    <title>{{ config('app.name', 'App') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        <main id="screen-loader"
            class="flex h-auto min-h-screen items-center justify-center rounded-lg bg-white dark:bg-gray-700 md:ml-64">
            <span
                class="box-border inline-block h-12 w-12 animate-spin rounded-full border-4 border-gray-200 border-b-blue-500"></span>
        </main>
        <!-- Page Content -->
        <main id="content" class="py-14" style="display: none">
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    <script src="{{ asset('js/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('js/dist/select2.min.js') }}"></script>
    <link href="{{ asset('css/dist/select2.min.css') }}" rel="stylesheet" />

    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    <script>
        // Show loader while the page is loading
        window.addEventListener('load', function() {
            document.getElementById('screen-loader').style.display = 'none';
            document.getElementById('content').style.display = 'block';
            if (sessionStorage.getItem('collapsed') == "false") {
                const sidebar = document.getElementById('drawer-navigation');
                sidebar.classList.replace('w-16', 'w-64');
                document.querySelectorAll('#drawer-navigation span').forEach((span) => {
                    span.classList.replace('hidden', 'flex');
                })
                document.getElementById('userInfo').classList.replace('hidden', 'flex');
                document.getElementById('cpr').classList.replace('hidden', 'flex');
                document.getElementById('drop-icon').classList.replace('hidden', 'flex');
                document.getElementById('collapseIcon').parentNode.classList.replace('rotate-180', 'rotate-0');
                document.querySelectorAll('main').forEach((main) => {
                    if (main.classList.contains('h-auto')) {
                        main.classList.replace('md:ml-20', 'md:ml-64')
                    }
                })
                
                document.querySelectorAll('#drawer-navigation li').forEach(li => {
                    li.setAttribute('titleData', li.title);
                    li.title = "";
                })
            }
        });

        //  A fallback in case 'load' event takes too long
        setTimeout(function() {
            document.getElementById('screen-loader').style.display = 'none';
            document.getElementById('content').style.display = 'block';
        }, 5000);
    </script>
</body>

</html>
