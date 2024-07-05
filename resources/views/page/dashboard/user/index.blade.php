<x-layout.dashboard class="dashboard-index" title="Users">
    
    {{-- Table --}}
    <x-table>
        <x-slot:head>
            <th></th>
            <th>Name</th>
            <th>ID</th>
            <th>Alamat</th>
            <th>Email</th>
            <th>No.Telp</th>
        </x-slot:head>
        <x-slot:body>
            @forelse ($users as $user)
                <tr>
                    <td width="1%">
                        <div class="action">
                            <a href="{{ route('dashboard.user.edit', compact('user')) }}" class="button"><i class="fa-solid fa-pencil"></i></a>
                            <x-form action="{{ route('dashboard.user.destroy', compact('user')) }}" method="DELETE">
                                <x-button type="submit"><i class="fa-solid fa-trash"></i></x-button>
                            </x-form>
                            <a href="{{ route('dashboard.user.show', compact('user')) }}" class="button"><i class="fa-solid fa-eye"></i></a>
                        </div>
                    </td>
                    <td>{{ $user->first_name .' '. $user->last_name }}</td>
                    <td align="center">{{ $user->code ?? '-' }}</td>
                    <td>{{ $user->address ?? '-' }}</td>
                    <td>{{ $user->email ?? '-' }}</td>
                    <td>{{ $user->phone ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty">No Data</td>
                </tr>
            @endforelse
        </x-slot:body>
    </x-table>
    
    {{-- Add --}}
    <a href="{{ route('dashboard.user.create') }}" class="add">
        <i class="fa-solid fa-plus"></i>
    </a>
    
</x-layout.dashboard>
