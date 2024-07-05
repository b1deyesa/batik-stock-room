<x-layout.dashboard class="dashboard-index">
    
    {{-- Graphics --}}
    <div class="graphics">
        <div class="category">
            <h5 class="title">Best Sellers</h5>
            <ul class="chart">
                @foreach ($BestSellers as $customer)
                    <li>
                        <span style="height: {{ $customer->total_purchase / $BestSellers->first()->total_purchase * 100 }}%"><small>{{ $customer->total_purchase }}</small></span>
                        <small>{{ $customer->first_name }}</small>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="category">
            <h5 class="title">Sell History</h5>
            <ul class="chart">
                @foreach ($SellHistory as $transaksi)
                    <li>
                        <span style="height: {{ $transaksi->total_transaksi / 500000 * 100 }}%"><small>{{ $transaksi->total_transaksi }}</small></span>
                        <small>{{ $transaksi->date }}</small>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    
    {{-- Stock --}}
    <div class="stock">
        <h5 class="title">Stock</h5>
        <x-table>
            <x-slot:head>
                <th style="white-space: nowrap">ID Batik</th>
                <th style="white-space: nowrap">Product</th>
                <th style="white-space: nowrap">Harga Beli</th>
                <th style="white-space: nowrap">Harga Jual</th>
                <th style="white-space: nowrap">Minimum Qty.</th>
                <th style="white-space: nowrap">Qty.</th>
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
                        <td width="1%">{{ $inventory->code ?? '-' }}</td>
                        <td width="100%">{{ $inventory->name ?? '-' }}</td>
                        <td style="white-space: nowrap">{{ $inventory->currency($inventory->harga_beli) ?? '-' }}</td>
                        <td style="white-space: nowrap">{{ $inventory->currency($inventory->harga_jual) ?? '-' }}</td>
                        <td align="center">{{ $inventory->min_quantity ?? '-' }}</td>
                        <td align="center">{{ $quantity ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty">No Data</td>
                    </tr>
                @endforelse
            </x-slot:body>
        </x-table>
    </div>
    
</x-layout.dashboard>