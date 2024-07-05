<x-layout.dashboard class="dashboard-index" title="Transactions">
    
    {{-- Navbar --}}
    <nav>
        <a href="{{ route('dashboard.buy.index') }}">Buy</a>
        <a href="{{ route('dashboard.sell.index') }}">Sell</a>
        <a href="{{ route('dashboard.requestion.index') }}" class="active">Request</a>
        <a href="{{ route('dashboard.returned.index') }}">Return</a>
        <a href="{{ route('dashboard.buy.report') }}">Report</a>
    </nav>
    
    {{-- Table --}}
    <x-table>
        <x-slot:head>
            <th style="white-space: nowrap">No. Transaksi</th>
            <th style="white-space: nowrap">ID Batik</th>
            <th style="white-space: nowrap">Produk</th>
            <th style="white-space: nowrap">Qty.</th>
            <th style="white-space: nowrap">Tanggal</th>
            <th></th>
        </x-slot:head>
        <x-slot:body>
            @forelse ($requestions as $requestion)
                <tr>
                    <td align="center">{{ $requestion->transaksi->code ?? '-' }}</td>
                    <td align="center">
                        @foreach ($requestion->transaksi->detailTransaksis as $detailTransaksi)
                            <ul>
                                <li>{{ $detailTransaksi->inventory->code }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($requestion->transaksi->detailTransaksis as $detailTransaksi)
                            <ul>
                                <li>{{ $detailTransaksi->inventory->name }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td align="center">
                        @foreach ($requestion->transaksi->detailTransaksis as $detailTransaksi)
                            <ul>
                                <li>{{ $detailTransaksi->quantity }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td align="center">{{ $requestion->transaksi->created_at->format('d/m/Y') ?? '-' }}</td>
                    <td width="1%">
                        <div class="status">
                            <x-form action="{{ route('dashboard.requestion.update', compact('requestion')) }}" method="PUT">
                                <input type="hidden" name="status" value="1">
                                <x-button type="submit"><i class="fa-regular fa-circle-check"></i></x-button>
                            </x-form>
                            <x-modal class="dashboard-modal">
                                <x-slot:trigger>
                                    <i class="fa-regular fa-circle-xmark"></i>
                                </x-slot:trigger>
                                <h6 class="title">Masukkan Alasannya</h6>
                                <x-form action="{{ route('dashboard.requestion.update', compact('requestion')) }}" method="PUT">
                                    <input type="hidden" name="status" :value="0">
                                    <x-input type="textarea" name="description" placeholder="Ketik..." />
                                    <div class="buttons">
                                        <a href="{{ route('dashboard.requestion.index') }}" class="button transparent">Cancel</a>
                                        <x-button type="submit">Accept</x-button>
                                    </div>
                                </x-form>
                            </x-modal>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty">No Data</td>
                </tr>
            @endforelse
        </x-slot:body>
    </x-table>
    
</x-layout.dashboard>