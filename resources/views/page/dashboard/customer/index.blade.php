<x-layout.dashboard class="dashboard-index" title="Customers">
    
    {{-- Table --}}
    <x-table>
        <x-slot:head>
            <th></th>
            <th>Name</th>
            <th>ID</th>
            <th>Email</th>
            <th>No.Telp</th>
        </x-slot:head>
        <x-slot:body>
            @forelse ($customers as $customer)
                <tr>
                    <td width="1%">
                        <div class="action">
                            <a href="{{ route('dashboard.customer.edit', compact('customer')) }}" class="button"><i class="fa-solid fa-pencil"></i></a>
                            <x-form action="{{ route('dashboard.customer.destroy', compact('customer')) }}" method="DELETE">
                                <x-button type="submit"><i class="fa-solid fa-trash"></i></x-button>
                            </x-form>
                            <a href="{{ route('dashboard.customer.show', compact('customer')) }}" class="button"><i class="fa-solid fa-eye"></i></a>
                        </div>
                    </td>
                    <td>{{ $customer->first_name .' '. $customer->last_name }}</td>
                    <td align="center">{{ $customer->code ?? '-' }}</td>
                    <td>{{ $customer->email ?? '-' }}</td>
                    <td>{{ $customer->phone ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty">No Data</td>
                </tr>
            @endforelse
        </x-slot:body>
    </x-table>
    
    {{-- Add --}}
    <a href="{{ route('dashboard.customer.create') }}" class="add">
        <i class="fa-solid fa-plus"></i>
    </a>
    
</x-layout.dashboard>
