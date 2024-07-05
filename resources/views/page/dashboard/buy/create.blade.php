<x-layout.dashboard title="Form Transactions">
    
    {{-- Navbar --}}
    <nav>
        <a href="{{ route('dashboard.buy.create') }}" class="active">Buy</a>
        <a href="{{ route('dashboard.sell.create') }}">Sell</a>
    </nav>
    
    {{-- Form --}}
    @livewire('dashboard.buy.create')
    
</x-layout.dashboard>