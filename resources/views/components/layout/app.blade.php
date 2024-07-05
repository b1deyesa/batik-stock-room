<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- Title --}}
    <title>{{ env('APP_NAME') . $title }}</title>
    
    {{-- Script --}}
    <script src="https://kit.fontawesome.com/4419d23bf4.js" crossorigin="anonymous"></script>
    <script src="{{ asset('asset/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('asset/vendor/ckeditor5/build/ckeditor.js') }}"></script>
    
    {{-- Vite --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @livewireStyles
</head>
<body @if($class)class="{{ $class }}"@endif>
    
    {{-- Alert --}}
    <x-alert />
    
    {{-- Slot --}}
    {{ $slot }}

    @livewireScripts
    @stack('scripts')
    <script src="{{ asset('asset/vendor/sortable.min.js') }}"></script>
</body>
</html>