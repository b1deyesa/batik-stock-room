<x-form wire="save" type="POST">
    
    {{-- Avatar --}}
    <div class="avatar">
         <img src="{{ asset('asset/img/default.png') }}">   
    </div>
    
    {{-- Detail --}}
    <div class="detail">
        <header>
            <h4 class="title">{{ $user->role->name }}</h4>
            <a href="{{ route('dashboard.profile.ganti-password') }}" class="button transparent">Ganti Password</a>
        </header>
        <x-input type="text" label="ID" :value="$user->code" :disabled="true" />
        <x-input type="text" label="First Name" wire="first_name" :value="$first_name" :required="true" />
        <x-input type="text" label="Last Name" wire="last_name" :value="$last_name" />
        <x-input type="text" label="Email ID" wire="email" :value="$email" :required="true" />
        <x-input type="number" label="Age" wire="age" :value="$age" />
        <x-input type="number" label="No. Telp" wire="phone" :value="$phone" />
        <x-input type="textarea" label="Address" wire="address" :value="$address" />
    </div>
    
    {{-- Buttons --}}
    <div class="buttons">
        <a href="{{ route('dashboard.profile.index') }}" class="button transparent">Cancel</a>
        <x-button type="submit">Save</x-button>
    </div>
        
</x-form>