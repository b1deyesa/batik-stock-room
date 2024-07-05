<x-layout.dashboard title="Add User" class="dashboard-form">
    
    {{-- Form --}}
    <x-form action="{{ route('dashboard.user.store') }}" method="POST">
        <x-input type="text" label="First Name" name="first_name" :required="true" />
        <x-input type="text" label="Last Name" name="last_name" />
        <x-input type="text" label="Email ID" name="email" :required="true" />
        <x-input type="password" label="Password" name="password" :required="true" />
        <x-input type="password" label="Confrim Password" name="password_confirmation" :required="true" />
        <x-input type="textarea" label="Address" name="address" />
        <x-input type="number" label="Age" name="age" />
        <x-input type="number" label="No. Telp" name="phone" />
        <x-input type="file" label="Avatar" name="avatar" />
        <x-input type="radio" label="Type" name="role" :options="$roles" :rows="true" :required="true" />
        <div class="buttons">
            <a href="{{ route('dashboard.user.index') }}" class="button transparent">Cancel</a>
            <x-button type="submit">Register</x-button>
        </div>
    </x-form>
    
</x-layout.dashboard>