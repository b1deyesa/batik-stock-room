<x-layout.dashboard title="Edit User" class="dashboard-form">
    
    {{-- Form --}}
    <x-form action="{{ route('dashboard.customer.update', compact('customer')) }}" method="PUT">
        <x-input type="text" label="First Name" name="first_name" :value="$customer->first_name" :required="true" />
        <x-input type="text" label="Last Name" name="last_name" :value="$customer->last_name" />
        <x-input type="text" label="Email ID" name="email" :value="$customer->email" />
        <x-input type="number" label="No. Telp" name="phone" :value="$customer->phone" />
        <x-input type="radio" label="Gender" name="gender" :options="['Male' => 'Male', 'Female' => 'Female']" :value="$customer->gender" :rows="true" />
        <div class="buttons">
            <a href="{{ route('dashboard.customer.index') }}" class="button transparent">Cancel</a>
            <x-button type="submit">Edit</x-button>
        </div>
    </x-form>
    
</x-layout.dashboard>