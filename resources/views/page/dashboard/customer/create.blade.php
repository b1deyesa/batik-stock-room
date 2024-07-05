<x-layout.dashboard title="Add Customer" class="dashboard-form">
    
    {{-- Form --}}
    <x-form action="{{ route('dashboard.customer.store') }}" method="POST">
        <x-input type="text" label="First Name" name="first_name" :required="true" />
        <x-input type="text" label="Last Name" name="last_name" />
        <x-input type="text" label="Email ID" name="email" />
        <x-input type="number" label="No. Telp" name="phone" />
        <x-input type="radio" label="Gender" name="gender" :options="['Male' => 'Male', 'Female' => 'Female']" :rows="true" />
        <div class="buttons">
            <a href="{{ route('dashboard.customer.index') }}" class="button transparent">Cancel</a>
            <x-button type="submit">Add</x-button>
        </div>
    </x-form>
    
</x-layout.dashboard>