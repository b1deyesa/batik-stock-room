<x-layout.dashboard class="dashboard-index" title="Report">
    
    {{-- Navbar --}}
    <nav>
        <a href="{{ route('dashboard.buy.report') }}" class="active">Report Buy</a>
        @if (Auth::user()->role->id == 1)
            <a href="{{ route('dashboard.sell.report') }}">Report Sell</a>
        @endif
    </nav>
    
    {{-- Filter --}}
    <x-form style="font-size: .85em" action="{{ route('dashboard.buy.report') }}" method="GET">
        <div class="buttons">
            <x-input type="date" name="from" value="{{ request('from') }}" />
            <x-input type="date" name="to" value="{{ request('to') }}" />
            <a href="{{ route('dashboard.buy.report') }}" class="button transparent">Clear</a>
            <x-button type="submit">Search</x-button>
        </div>
    </x-form>
    
    {{-- Table --}}
    <x-table>
        <x-slot:head>
            <th style="white-space: nowrap">Tanggal</th>
            <th style="white-space: nowrap">No. Transaksi</th>
            <th style="white-space: nowrap">Nama Batik</th>
            <th style="white-space: nowrap">ID Anggota</th>
            <th style="white-space: nowrap">Qty.</th>
            <th style="white-space: nowrap">Harga</th>
            <th style="white-space: nowrap">Total</th>
        </x-slot:head>
        <x-slot:body>
            @foreach ($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->created_at->format('d/m/Y') }}</td>
                    <td align="center">{{ $transaksi->code }}</td>
                    <td width="100%">
                        @foreach ($transaksi->detailTransaksis as $detailTransaksi)
                            <ul>
                                <li>{{ $detailTransaksi->inventory->name }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td align="center">{{ $transaksi->user->code }}</td>
                    <td align="center">
                        @foreach ($transaksi->detailTransaksis as $detailTransaksi)
                            <ul>
                                <li>{{ $detailTransaksi->quantity }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td style="white-space: nowrap">
                        @foreach ($transaksi->detailTransaksis as $detailTransaksi)
                            <ul>
                                <li>{{ $detailTransaksi->inventory->currency($detailTransaksi->inventory->harga_jual * $detailTransaksi->quantity) }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td style="white-space: nowrap">{{ "Rp " . number_format($transaksi->grandtotal, 2, ',', '.'); }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="9" align="end">
                    <b>Total Pendapatan :</b> {{ "Rp " . number_format($transaksis->sum('grandtotal'), 2, ',', '.'); }}<br>
                    <b>Total Transaksi :</b> {{ $transaksis->count() }}
                </td>
            </tr>
        </x-slot:body>
    </x-table>
    
    {{-- Print --}}
    @if (request('from') && request('to'))
        <a style="display: flex; gap: .4em; align-self: flex-end" href="{{ route('dashboard.buy.report.download', ['from' => request('from'), 'to' => request('to')]) }}" class="button transparent"><i class="fa-solid fa-print"></i>Download</a>
    @else 
        <a style="display: flex; gap: .4em; align-self: flex-end" href="{{ route('dashboard.buy.report.download') }}" class="button transparent"><i class="fa-solid fa-print"></i>Download</a>
    @endif
    
</x-layout.dashboard>
