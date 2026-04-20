<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="openlinks-dark">
<head>
    @include('layouts.components.head')
</head>
<body>
    {{ $slot }}
</body>
</html>
