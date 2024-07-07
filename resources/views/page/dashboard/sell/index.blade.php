<x-layout.dashboard class="dashboard-index" title="Transactions">
    
    {{-- Navbar --}}
    <nav>
        <a href="{{ route('dashboard.buy.index') }}">Buy</a>
        @if (Auth::user()->role->id == 1)
            <a href="{{ route('dashboard.sell.index') }}" class="active">Sell</a>
        @endif
        @if (Auth::user()->role->id == 2)
            <a href="{{ route('dashboard.requestion.index') }}">Request</a>
        @endif
        <a href="{{ route('dashboard.returned.index') }}">Return</a>
        <a href="{{ route('dashboard.buy.report') }}">Report</a>
    </nav>
    
    {{-- Table --}}
    <x-table>
        <x-slot:head>
            <th></th>
            <th style="white-space: nowrap">No. Transaksi</th>
            <th style="white-space: nowrap">ID Customer</th>
            <th style="white-space: nowrap">Tanggal</th>
            <th style="white-space: nowrap">Total</th>
            <th style="white-space: nowrap">Status</th>
        </x-slot:head>
        <x-slot:body>
            @forelse ($transaksis as $transaksi)
                <tr>
                    <td width="1%">
                        <div class="action">
                            <a href="{{ route('dashboard.sell.edit', ['sell' => $transaksi]) }}" class="button"><i class="fa-solid fa-pencil"></i></a>
                            <x-form action="{{ route('dashboard.sell.destroy', ['sell' => $transaksi]) }}" method="DELETE">
                                <x-button type="submit"><i class="fa-solid fa-trash"></i></x-button>
                            </x-form>
                        </div>
                    </td>
                    <td align="center">{{ $transaksi->code ?? '-' }}</td>
                    <td align="center">{{ $transaksi->buyer ?? '-' }}</td>                    
                    <td align="center">{{ $transaksi->created_at->format('d/m/Y') ?? '-' }}</td>
                    <td width="100%" style="white-space: nowrap">{{ "Rp " . number_format($transaksi->grandtotal, 2, ',', '.'); }}</td>
                    <td align="center">
                        <div class="status">
                            @if ($transaksi->returneds->first()?->isReturn == true)
                                <span class="danger">Return</span>
                            @else
                                <span class="success">Berhasil</span>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="empty">No Data</td>
                </tr>
            @endforelse
        </x-slot:body>
    </x-table>
    
    {{-- Add --}}
    <a href="{{ route('dashboard.sell.create') }}" class="add">
        <i class="fa-solid fa-plus"></i>
    </a>
    
</x-layout.dashboard>