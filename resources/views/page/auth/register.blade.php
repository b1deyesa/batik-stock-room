<x-layout.auth>
    <x-form action="{{ route('auth.register.post') }}" method="POST">
        <h4 class="title">Register</h4>
        <x-input type="text" placeholder="First Name" name="first_name" :required="true" />
        <x-input type="text" placeholder="Last Name" name="last_name" />
        <x-input type="text" placeholder="Email ID" name="email" :required="true" />
        <x-input type="password" placeholder="Password" name="password" :required="true" />
        <x-input type="password" placeholder="Confirm Password" name="password_confirmation" :required="true" />
        <x-input type="select" placeholder="Register As" name="role" :options="$roles" :required="true" />
        <x-button type="submit">Register</x-button>
        <p>Have an account? <a href="{{ route('auth.login.index') }}">Login</a></p>
    </x-form>
</x-layout.auth>