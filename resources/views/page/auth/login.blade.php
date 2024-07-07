<x-layout.auth>
    <x-form action="{{ route('auth.login.post') }}" method="POST">
        <h4 class="title">Login</h4>
        <x-input type="text" placeholder="Username" name="username" />
        <x-input type="password" placeholder="Password" name="password" />
        <x-button type="submit">Login</x-button>
    </x-form>
</x-layout.auth>