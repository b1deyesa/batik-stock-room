<x-layout.dashboard class="dashboard-index" title="Inventory">
    
    {{-- Navbar --}}
    <nav>
        <a href="{{ route('dashboard.inventory.index') }}">Stock</a>
        <a href="{{ route('dashboard.inventory.report') }}" class="active">Report</a>
    </nav>
    
    {{-- Table --}}
    <x-table>
        <x-slot:head>
            <th style="white-space: nowrap">ID Batik</th>
            <th style="white-space: nowrap">Product</th>
            <th style="white-space: nowrap">Quantity</th>
        </x-slot:head>
        <x-slot:body>
            @forelse ($inventories as $inventory)
                @php
                    $quantitySell = $inventory->detailTransaksis()->whereHas('transaksi', function($query) { $query->where('type', 'sell'); })->get()->sum('quantity');
                    $quantityBuy = $inventory->detailTransaksis()->whereHas('transaksi', function($query) {$query->where('type', 'buy'); })->whereHas('transaksi.requestions', function($query) {$query->where('status', true); })->get()->filter(function($detailTransaksi) {return $detailTransaksi->transaksi->requestions->firstWhere('status', true); })->sum('quantity');
                    $quantityReturned = $inventory->detailTransaksis()->whereHas('transaksi.returneds', function ($query) { $query->where('isReturn', true)->orderBy('id')->take(1); })->get()->sum('quantity');
                    $quantity = $quantityBuy - $quantitySell + $quantityReturned;
                @endphp
                <tr>
                    <td align="center" style="white-space: nowrap">{{ $inventory->code ?? '-' }} @if($quantity - $inventory->min_quantity < 2)<span style="color: red"><i class="fa-solid fa-exclamation"></i></span>@endif</td>
                    <td width="100%">
                        <div class="buttons">
                            {{ $inventory->name ?? '-' }}
                            <x-modal :close="true">
                                <x-slot:trigger>
                                    <i class="fa-regular fa-file-lines"></i>
                                </x-slot:trigger>
                                <table>
                                    <tr>
                                        <th>No. Transaction</th>
                                        <th>Type</th>
                                        <th>Qty.</th>
                                    </tr>
                                    @forelse ($inventory->detailTransaksis as $detailTransaksi)
                                        <tr>
                                            <td align="center">{{ $detailTransaksi->transaksi->code }}</td>
                                            <td align="center">{{ $detailTransaksi->transaksi->type }}</td>
                                            <td align="center">
                                                @if ($detailTransaksi->transaksi->type == 'Sell')
                                                    -{{ $detailTransaksi->quantity }}
                                                @else
                                                    {{ $detailTransaksi->quantity }}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="empty">No History</td>
                                        </tr>
                                    @endforelse
                                </table>
                            </x-modal>
                        </div>
                    </td>
                    <td align="center">{{ $quantity ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty">No Data</td>
                </tr>
            @endforelse
        </x-slot:body>
    </x-table>
    
</x-layout.dashboard>
