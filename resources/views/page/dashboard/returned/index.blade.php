<x-layout.dashboard class="dashboard-index" title="Transactions">
    
    {{-- Navbar --}}
    <nav>
        <a href="{{ route('dashboard.buy.index') }}">Buy</a>
        <a href="{{ route('dashboard.sell.index') }}">Sell</a>
        <a href="{{ route('dashboard.requestion.index') }}">Request</a>
        <a href="{{ route('dashboard.returned.index') }}" class="active">Return</a>
        <a href="{{ route('dashboard.buy.report') }}">Report</a>
    </nav>
    
    {{-- Table Transaction List --}}
    <x-table>
        <x-slot:head>
            <th style="white-space: nowrap">Type</th>
            <th style="white-space: nowrap">No. Transaksi</th>
            <th style="white-space: nowrap">ID Batik</th>
            <th style="white-space: nowrap">Produk</th>
            <th style="white-space: nowrap">Qty.</th>
            <th style="white-space: nowrap">Tanggal</th>
            <th></th>
        </x-slot:head>
        <x-slot:body>
            @forelse ($transaksis as $transaksi)
                <tr>
                    <td align="center">{{ $transaksi->type ?? '-' }}</td>
                    <td align="center">{{ $transaksi->code ?? '-' }}</td>
                    <td align="center">
                        @foreach ($transaksi->detailTransaksis as $detailTransaksi)
                            <ul>
                                <li>{{ $detailTransaksi->inventory->code }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td width="100%">
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
                    <td align="center">{{ $transaksi->created_at->format('d/m/Y') ?? '-' }}</td>
                    <td width="1%">
                        <x-modal class="dashboard-modal">
                            <x-slot:trigger>
                                <x-button class="transparent">Return</x-button>
                            </x-slot:trigger>
                            <h6 class="title">Masukkan Alasannya</h6>
                            <x-form action="{{ route('dashboard.returned.store') }}" method="POST">
                                <input type="hidden" name="transaksi" value="{{ $transaksi->id }}">
                                <x-input type="textarea" name="description" placeholder="Ketik..." />
                                <div class="buttons">
                                    <a href="{{ route('dashboard.returned.index') }}" class="button transparent">Cancel</a>
                                    <x-button type="submit">Accept</x-button>
                                </div>
                            </x-form>
                        </x-modal>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty">No Data</td>
                </tr>
            @endforelse
        </x-slot:body>
    </x-table>
    
    {{-- HR --}}
    <hr>
    
    {{-- Table Return List --}}
    <h6>Request Return</h6>
    <x-table>
        <x-slot:head>
            <th style="white-space: nowrap">Type</th>
            <th style="white-space: nowrap">No. Transaksi</th>
            <th style="white-space: nowrap">Deskripsi</th>
            <th style="white-space: nowrap">Status</th>
            <th></th>
        </x-slot:head>
        <x-slot:body>
            @forelse ($returneds as $returned)
                <tr>
                    <td align="center">{{ $returned->transaksi->type ?? '-' }}</td>
                    <td align="center">{{ $returned->transaksi->code ?? '-' }}</td>
                    <td width="100%">{{ $returned->description ?? '-' }}</td>
                    <td width="1%">
                        <div class="status">
                            @if (!is_null($returned->isReturn))
                                @if ($returned->isReturn == true)
                                    <span class="success">Berhasil</span>
                                @else
                                    <span class="danger">Ditolak</span>
                                @endif
                            @else
                                <span class="warning">Process</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div class="status">
                            <x-form action="{{ route('dashboard.returned.update', compact('returned')) }}" method="PUT">
                                <input type="hidden" name="isReturn" value="1">
                                <x-button type="submit"><i class="fa-regular fa-circle-check"></i></x-button>
                            </x-form>
                            <x-form action="{{ route('dashboard.returned.update', compact('returned')) }}" method="PUT">
                                <input type="hidden" name="isReturn" value="0">
                                <x-button type="submit"><i class="fa-regular fa-circle-xmark"></i></x-button>
                            </x-form>
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