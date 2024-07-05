<x-layout.app class="auth">
    <img src="{{ asset('asset/img/batik-pettern.jpeg') }}">
    <div class="container">
        <img src="{{ asset('asset/img/logo.png') }}" alt="Logo">
        {{ $slot }}
    </div>
</x-layout.app>