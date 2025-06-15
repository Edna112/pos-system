<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Inventory Management System') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>
    <div class="min-h-screen bg-gray-100">
        @include('layouts.body.navbar')
        <main>
            {{ $slot }}
        </main>
    </div>
    @stack('scripts')
</body>
</html> 