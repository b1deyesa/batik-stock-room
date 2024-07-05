<x-layout.app class="dashboard">
    
    {{-- Sidebar --}}
    <section class="sidebar">
        <div class="profile">
            <img src="{{ asset('asset/img/default.png') }}">
            <span>{{ auth()->user()->first_name }}</span>
            <a href="{{ route('dashboard.profile.index') }}"><small>Edit</small></a>
        </div>
        <div class="menu">
            <a href="{{ route('dashboard.index') }}" class="menu-item">
                <i class="fa-solid fa-house"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('dashboard.inventory.index') }}" class="menu-item">
                <i class="fa-solid fa-box"></i>
                <span>Inventory</span>
            </a>
            @if (Auth::user()->role->id == 1)
                <a href="{{ route('dashboard.user.index') }}" class="menu-item">
                    <i class="fa-solid fa-user"></i>
                    <span>User</span>
                </a>
            @endif
            <a href="{{ route('dashboard.buy.index') }}" class="menu-item">
                <i class="fa-solid fa-wallet"></i>
                <span>Transactions</span>
            </a>
            <a href="{{ route('dashboard.customer.index') }}" class="menu-item">
                <i class="fa-solid fa-users"></i>
                <span>Customer</span>
            </a>
            <a href="" class="menu-item">
                <i class="fa-solid fa-bell"></i>
                <span>Pesan</span>
            </a>
        </div>
        <x-form action="{{ route('auth.logout.post') }}" method="POST" class="logout">
            <x-button type="submit">Logout</x-button>
        </x-form>
    </section>
    
    {{-- Content --}}
    <section class="content {{ $class }}">
        {{-- Title --}}
        @if ($title)<h3 class="title">{{ $title }}</h3>@endif
        {{ $slot }}
    </section>
    
</x-layout.app>