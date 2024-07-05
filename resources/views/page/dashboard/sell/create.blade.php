<x-layout.dashboard title="Form Transactions">
    
    {{-- Navbar --}}
    <nav>
        <a href="{{ route('dashboard.buy.create') }}">Buy</a>
        <a href="{{ route('dashboard.sell.create') }}" class="active">Sell</a>
    </nav>
    
    {{-- Form --}}
    @livewire('dashboard.sell.create')
    
</x-layout.dashboard>