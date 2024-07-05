<x-layout.dashboard class="dashboard-index" title="Transactions">
    
    {{-- Navbar --}}
    <nav>
        <a href="{{ route('dashboard.buy.index') }}" class="active">Buy</a>
        <a href="{{ route('dashboard.sell.index') }}">Sell</a>
        <a href="{{ route('dashboard.requestion.index') }}">Request</a>
        <a href="{{ route('dashboard.returned.index') }}">Return</a>
        <a href="{{ route('dashboard.buy.report') }}">Report</a>
    </nav>
    
    {{-- Table --}}
    <x-table>
        <x-slot:head>
            <th></th>
            <th>No. Transaksi</th>
            <th>ID Anggota</th>
            <th>ID Batik</th>
            <th>Nama Batik</th>
            <th>Qty.</th>
            <th>Harga</th>
            <th>Tanggal</th>
            <th>Status</th>
        </x-slot:head>
        <x-slot:body>
            @forelse ($transaksis as $transaksi)
                <tr>
                    <td width="1%">
                        <div class="action">
                            <a href="{{ route('dashboard.buy.edit', ['buy' => $transaksi]) }}" class="button"><i class="fa-solid fa-pencil"></i></a>
                            <x-form action="{{ route('dashboard.buy.destroy', ['buy' => $transaksi]) }}" method="DELETE">
                                <x-button type="submit"><i class="fa-solid fa-trash"></i></x-button>
                            </x-form>
                        </div>
                    </td>
                    <td align="center">{{ $transaksi->code ?? '-' }}</td>
                    <td align="center">{{ $transaksi->user->code ?? '-' }}</td>
                    <td align="center">
                        @foreach ($transaksi->detailTransaksis as $detailTransaksi)
                            <ul>
                                <li>{{ $detailTransaksi->inventory->code }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($transaksi->detailTransaksis as $detailTransaksi)
                            <ul>
                                <li>{{ $detailTransaksi->inventory->name }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td align="center">
                        @foreach ($transaksi->detailTransaksis as $detailTransaksi)
                            <ul>
                                <li>{{ $detailTransaksi->quantity }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($transaksi->detailTransaksis as $detailTransaksi)
                            <ul>
                                <li>{{ $detailTransaksi->inventory->currency($detailTransaksi->inventory->harga_jual) }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td width="1%" style="white-space: nowrap">{{ $transaksi->created_at }}</td>
                    <td align="center">
                        <div class="status">
                            @if ($transaksi->returneds->first()?->isReturn == true)
                                <span class="danger">Return</span>
                            @else
                                @if (!is_null($transaksi->requestions->first()->status))
                                    @if ($transaksi->requestions->first()->status == true)
                                        @if ($transaksi->requestions->first()->user->role->id == 1)
                                            <span class="warning">Acc. Admin</span>
                                        @else
                                            <span class="success">Acc. Anggota</span>
                                        @endif
                                    @else
                                        <span class="danger">Ditolak 
                                            <x-modal :close="true" class="dashboard-modal">
                                                <x-slot:trigger>
                                                    <i class="fa-solid fa-eye"></i>
                                                </x-slot:trigger>
                                                <h6 class="title">Alasannya:</h6>
                                                <p>{{ $transaksi->requestions->first()->description }}</p>
                                            </x-modal>
                                        </span>
                                    @endif
                                @else
                                    -
                                @endif
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
    <a href="{{ route('dashboard.buy.create') }}" class="add">
        <i class="fa-solid fa-plus"></i>
    </a>
    
</x-layout.dashboard>