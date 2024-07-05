<x-layout.dashboard class="dashboard-form" title="Ganti Password">
    
    {{-- Form --}}
    <x-form action="{{ route('dashboard.profile.ganti-password.post') }}" method="POST">
        <x-input type="password" label="Password Lama" name="old_password" />
        <x-input type="password" label="Password Baru" name="password" />
        <x-input type="password" label="Konfirmasi Password Baru" name="password_confirmation" />
        <div class="buttons">
            <a href="{{ route('dashboard.profile.index') }}" class="button transparent">Cancel</a>
            <x-button type="submit">Oke</x-button>
         </div>
    </x-form>
    
</x-layout.dashboard>