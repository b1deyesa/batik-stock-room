<x-layout.dashboard class="dashboard-show" title="Customer Detail">
    
    <ul class="list">
        <li class="item">
            <small>ID</small>
            <span>{{ $customer->code }}</span>
        </li>
        <li class="item">
            <small>Name</small>
            <span>{{ $customer->first_name .' '. $customer->last_name }}</span>
        </li>
        <li class="item">
            <small>Email</small>
            <span>{{ $customer->email ?? '-' }}</span>
        </li>
        <li class="item">
            <small>No. Telp</small>
            <span>{{ $customer->phone ?? '-' }}</span>
        </li>
        <li class="item">
            <small>Gender</small>
            <span>{{ $customer->gender ?? '-' }}</span>
        </li>
    </ul>
    
    <a href="{{ route('dashboard.customer.index') }}" class="button transparent">Back</a>
    
</x-layout.dashboard>