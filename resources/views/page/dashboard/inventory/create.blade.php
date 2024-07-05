<x-layout.dashboard title="Add Product" class="dashboard-form">
    
    {{-- Form --}}
    <x-form action="{{ route('dashboard.inventory.store') }}" method="POST">
        <x-input type="text" label="Nama Batik" name="name" :required="true" />
        <x-input type="number" label="Harga Beli" name="harga_beli" />
        <x-input type="number" label="Harga Jual" name="harga_jual" />
        <x-input type="select" label="ID Anggota" :options="$users" name="user" placeholder="Pilih Anggota" :required="true" />
        <div class="buttons">
            <a href="{{ route('dashboard.inventory.index') }}" class="button transparent">Cancel</a>
            <x-button type="submit">Accept</x-button>
        </div>
    </x-form>
    
</x-layout.dashboard>