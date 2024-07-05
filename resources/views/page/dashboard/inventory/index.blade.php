<x-layout.dashboard class="dashboard-index" title="Inventory">
    
    {{-- Navbar --}}
    <nav>
        <a href="{{ route('dashboard.inventory.index') }}" class="active">Stock</a>
        <a href="{{ route('dashboard.inventory.report') }}">Report</a>
    </nav>
    
    {{-- Table --}}
    <x-table>
        <x-slot:head>
            <th style="white-space: nowrap">ID Batik</th>
            <th style="white-space: nowrap">Product</th>
            <th style="white-space: nowrap">Harga Beli</th>
            <th style="white-space: nowrap">Harga Jual</th>
            <th style="white-space: nowrap">Minimum Qty.</th>
            <th style="white-space: nowrap">Qty.</th>
            <th style="white-space: nowrap">ID Anggota</th>
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
                    <td width="1%">
                        <div class="action">
                            {{ $inventory->code ?? '-' }}
                            <x-modal class="dashboard-modal">
                                <x-slot:trigger>
                                    <i class="fa-solid fa-trash"></i>
                                </x-slot:trigger>
                                <h5 class="title">Hapus Stock</h5>
                                <table>
                                    <tr>
                                        <td>ID Batik</td>
                                        <td>{{ $inventory->code ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Batik</td>
                                        <td>{{ $inventory->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Harga Beli</td>
                                        <td>{{ $inventory->harga_beli ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Harga Jual</td>
                                        <td>{{ $inventory->harga_jual ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Quantity</td>
                                        <td>{{ $inventory->quantity ?? '-' }}</td>
                                    </tr>
                                </table>
                                <x-form action="{{ route('dashboard.inventory.destroy', compact('inventory')) }}" method="DELETE">
                                    <div class="buttons">
                                        <a href="{{ route('dashboard.inventory.index') }}" class="button transparent">Cancel</a>
                                        <x-button type="submit">Accept</x-button>
                                    </div>
                                </x-form>
                            </x-modal>
                        </div>
                    </td>
                    <td width="100%">{{ $inventory->name ?? '-' }}</td>
                    <td style="white-space: nowrap">{{ $inventory->currency($inventory->harga_beli) ?? '-' }}</td>
                    <td style="white-space: nowrap">{{ $inventory->currency($inventory->harga_jual) ?? '-' }}</td>
                    <td align="center">
                        <div class="action">
                            {{ $inventory->min_quantity ?? '-' }}
                            <x-modal class="dashboard-modal">
                                <x-slot:trigger>
                                    <i class="fa-solid fa-pencil"></i>
                                </x-slot:trigger>
                                <h5 class="title">Edit Minimum Stock</h5>
                                <table>
                                    <tr>
                                        <td>ID Batik</td>
                                        <td>{{ $inventory->code ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Batik</td>
                                        <td>{{ $inventory->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>ID Anggota</td>
                                        <td>{{ $inventory->user->code ?? '-' }}</td>
                                    </tr>
                                </table>
                                <x-form action="{{ route('dashboard.inventory.update-minimum-stock', compact('inventory')) }}" method="POST">
                                    <x-input type="number" label="Quantity" name="min_quantity" :value="$inventory->min_quantity" />
                                    <div class="buttons">
                                        <a href="{{ route('dashboard.inventory.index') }}" class="button transparent">Cancel</a>
                                        <x-button type="submit">Accept</x-button>
                                    </div>
                                </x-form>
                            </x-modal>
                        </div>
                    </td>
                    
                    <td align="center">{{ $quantity ?? '-' }}</td>
                    <td align="center">{{ $inventory->user->code ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty">No Data</td>
                </tr>
            @endforelse
        </x-slot:body>
    </x-table>
    
    {{-- Add --}}
    <a href="{{ route('dashboard.inventory.create') }}" class="add">
        <i class="fa-solid fa-plus"></i>
    </a>
    
</x-layout.dashboard>
