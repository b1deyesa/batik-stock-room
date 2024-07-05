<x-layout.dashboard class="dashboard-show" title="User Detail">
    
    <ul class="list">
        <li class="item">
            <small>ID</small>
            <span>{{ $user->code }}</span>
        </li>
        <li class="item">
            <small>Name</small>
            <span>{{ $user->first_name .' '. $user->last_name }}</span>
        </li>
        <li class="item">
            <small>Email</small>
            <span>{{ $user->email ?? '-' }}</span>
        </li>
        <li class="item">
            <small>Alamat</small>
            <span>{{ $user->address ?? '-' }}</span>
        </li>
        <li class="item">
            <small>Usia</small>
            <span>{{ $user->age ?? '-' }}</span>
        </li>
        <li class="item">
            <small>No. Telp</small>
            <span>{{ $user->phone ?? '-' }}</span>
        </li>
        <li class="item">
            <small>Avatar</small>
            <span>{{ $user->avatar ?? '-' }}</span>
        </li>
        <li class="item">
            <small>Type</small>
            <span>{{ $user->role->name }}</span>
        </li>
    </ul>
    
    <a href="{{ route('dashboard.user.index') }}" class="button transparent">Back</a>
    
</x-layout.dashboard>