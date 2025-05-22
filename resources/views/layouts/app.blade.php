<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Dashboard') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" href="{{ asset('build/assets/logo.png') }}" type="image/png">

        <!-- AdminLTE CSS -->
        <link rel="stylesheet" href="{{ asset('build/assets/adminlte.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex">

            {{-- Sidebar --}}
            @include('layouts.sidebar')

            {{-- Main content --}}
            <div class="flex-1">
                {{-- Navigation bar --}}
                @include('layouts.navigation')

                {{-- Page Heading --}}
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                {{-- Page Content --}}
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>

        <!-- Bootstrap Bundle (includes Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- AdminLTE JS -->
        <script src="{{ asset('build/assets/adminlte.js') }}"></script>

        <!-- Sidebar Toggle Manual -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                document.querySelector('[data-widget="pushmenu"]')?.addEventListener('click', function () {
                    document.body.classList.toggle('sidebar-collapse');
                });
            });
        </script>
    </body>
</html>
