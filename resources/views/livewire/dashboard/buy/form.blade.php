<div class="transaksi-form">
    
    {{-- Form Transaksi --}}
    <x-form>
        <h6 class="title">Transaction</h6>
        <x-input type="text" label="No. Transaksi" wire="no_transaksi" :disabled="true" />
        <x-input type="select" label="ID Anggota" wire="user" :options="$anggotas" placeholder=" " :required="true" />
        <x-input type="text" label="Tanggal" wire="tanggal" :disabled="true" />
    </x-form>
    
    {{-- Form Product --}}
    <x-form wire="add">
        <h6 class="title">Add Product</h6>
        <x-input type="select" label="ID Batik" live="batik" :options="$inventories" placeholder=" " :required="true" />
        <x-input type="text" label="Nama Batik" wire="name" :disabled="true" />
        <x-input type="number" label="Quantity" wire="quantity" :required="true" />
        <x-input type="text" label="Harga" wire="harga_jual" :disabled="true" />
        <div class="buttons">
            <x-button wire="clear" class="transparent">Cancel</x-button>
            <x-button type="submit">Add</x-button>
        </div>
    </x-form>
    
    {{-- HR --}}
    <hr>
    
    {{-- Table --}}
    <x-table>
        <x-slot:head>
            <th></th>
            <th style="white-space: nowrap">ID Batik</th>
            <th style="white-space: nowrap">Nama Batik</th>
            <th style="white-space: nowrap">ID Anggota</th>
            <th style="white-space: nowrap">Price</th>
            <th style="white-space: nowrap">Quantity</th>
            <th style="white-space: nowrap">Sub Total</th>
        </x-slot:head>
        <x-slot:body>
            @forelse ($products as $index => $product)
                <tr>
                    <td width="1%">
                        <div class="action">
                            <x-button wire="remove({{ $index }})"><i class="fa-solid fa-xmark"></i></x-button>
                        </div>
                    </td>
                    <td align="center">{{ $product['code'] }}</td>
                    <td width="100%">{{ $product['name'] }}</td>
                    <td align="center">{{ $product['user'] }}</td>
                    <td style="white-space: nowrap">{{ "Rp " . number_format($product['harga_jual'], 2, ',', '.'); }}</td>
                    <td align="center">{{ $product['quantity'] }}</td>
                    <td style="white-space: nowrap">{{ "Rp " . number_format($product['total'], 2, ',', '.'); }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="empty">No Data</td>
                </tr>
            @endforelse
            <tr>
                <td class="total" colspan="9" align="end"><h6>Total : {{ "Rp " . number_format($total, 2, ',', '.'); }}</h6></td>
            </tr>
        </x-slot:body>
    </x-table> 
    
    @error('total')
        <span class="error">Fill the list</span>
    @enderror
    
    {{-- Buttons --}}
    <div class="buttons">
        <a href="{{ route('dashboard.buy.index') }}" class="button transparent">Cancel</a>
        <x-button wire="save">Oke</x-button>
    </div>
    
</div>