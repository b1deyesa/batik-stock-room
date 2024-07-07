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
                            <x-modal class="dashboard-modal">
                                <x-slot:trigger>
                                    <x-button><i class="fa-solid fa-trash"></i></x-button>
                                </x-slot:trigger>
                                <h6 class="title">Delete Customer</h6>
                                Konfirmasi menghapus customer {{ $customer->code }}
                                <x-form action="{{ route('dashboard.customer.destroy', compact('customer')) }}" method="DELETE">
                                    <div class="buttons">
                                        <a href="{{ route('dashboard.customer.index') }}" class="button transparent">Cancel</a>
                                        <x-button type="submit">Accept</x-button>
                                    </div>
                                </x-form>
                            </x-modal>
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
