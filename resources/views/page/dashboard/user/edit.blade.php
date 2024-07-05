<x-layout.dashboard title="Edit User" class="dashboard-form">
    
    {{-- Form --}}
    <x-form action="{{ route('dashboard.user.update', compact('user')) }}" method="PUT">
        <x-input type="text" label="First Name" name="first_name" :value="$user->first_name" :required="true" />
        <x-input type="text" label="Last Name" name="last_name" :value="$user->last_name" />
        <x-input type="text" label="Email ID" name="email" :value="$user->email" :required="true" />
        <x-input type="textarea" label="Address" name="address" :value="$user->address" />
        <x-input type="number" label="Age" name="age" :value="$user->age" />
        <x-input type="number" label="No. Telp" name="phone" :value="$user->phone" />
        <div class="buttons">
            <a href="{{ route('dashboard.user.index') }}" class="button transparent">Cancel</a>
            <x-button type="submit">Edit</x-button>
        </div>
    </x-form>
    
</x-layout.dashboard>