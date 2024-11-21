<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'CRM System') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                <!-- Flash Messages -->
                @if (session('success'))
                    <div class="alert alert-success bg-green-100 text-green-800 border border-green-400 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-error bg-red-100 text-red-800 border border-red-400 p-4 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if (session('warning'))
                    <div class="alert alert-warning bg-yellow-100 text-yellow-800 border border-yellow-400 p-4 rounded mb-4">
                        {{ session('warning') }}
                    </div>
                @endif

                @if (session('info'))
                    <div class="alert alert-info bg-blue-100 text-blue-800 border border-blue-400 p-4 rounded mb-4">
                        {{ session('info') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>

        {{-- This is to make the alert disappear after 10 seconds --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                setTimeout(() => {
                    const alerts = document.querySelectorAll('.alert');
                    alerts.forEach(alert => alert.remove());
                }, 10000); // Alerts disappear after 10 seconds
            });
        </script>
    </body>
</html>
