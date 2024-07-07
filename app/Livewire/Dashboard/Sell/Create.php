<?php

namespace App\Livewire\Dashboard\Sell;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $no_transaksi;
    public $tanggal;
    public $customer;
    public $total;
    
    public $batik;
    public $name;
    public $harga_jual;
    public $quantity;
    
    public $customers;
    public $inventories;
    public $products = [];
    
    public function mount()
    {
        $last_transaksi_id = Transaksi::latest()->first()?->id;
        $transaksi_code = 'TRS_'. sprintf('%03d', $last_transaksi_id + 1);
        $this->no_transaksi = $transaksi_code;
        $this->tanggal = today()->format('d F Y');
        
        $this->customers = Customer::all()->pluck('code', 'id')->toArray();
        $this->inventories = Inventory::all()->pluck('code', 'id')->toArray();
    }
    
    public function updatedBatik($id)
    {
        $inventory = Inventory::find($id);
                
        $this->name = $inventory->name;
        $this->harga_jual = $inventory->harga_jual;
        $this->quantity = $inventory->quantity;
    }
    
    public function clear()
    {
        $this->batik = null;
        $this->name = null;
        $this->harga_jual = null;
        $this->quantity = null;
    }
    
    public function add()
    {
        $this->validate([
            'batik' => 'required',
            'quantity' => 'required'
        ]);
        
        $inventory = Inventory::find($this->batik);
        
        $this->products[] = [
            'id' => $inventory->id,
            'code' => $inventory->code,
            'name' => $inventory->name,
            'user' => $inventory->user->code,
            'harga_jual' => $inventory->harga_jual,
            'quantity' => $this->quantity,
            'total' => $this->quantity * $this->harga_jual
        ];
        
        $this->total += $this->quantity * $this->harga_jual;
        
        $this->batik = null;
        $this->name = null;
        $this->harga_jual = null;
        $this->quantity = null;
    }
    
    public function remove($index)
    {
        $this->total -= $this->products[$index]['quantity'] * $this->products[$index]['harga_jual'];
        unset($this->products[$index]);
    }
    
    public function save()
    {
        $this->validate([
            'customer' => 'required',
            'total' => 'required|not_in:0'
        ]);
        
        $customer_code = Customer::find($this->customer)->code;
        
        $transaksi = Transaksi::create([
            'user_id' => Auth::user()->id,
            'code' => $this->no_transaksi,
            'type' => 'Sell',
            'grandtotal' => $this->total,
            'buyer' => $customer_code
        ]);
        
        foreach ($this->products as $product) {
            DetailTransaksi::create([
               'transaksi_id' => $transaksi->id, 
               'inventory_id' => $product['id'], 
               'quantity' => $product['quantity'] 
            ]);
        }
        
        return redirect()->route('dashboard.sell.index')->with('success', 'Transaction Successfuly');
    }
    
    public function render()
    {
        return view('livewire.dashboard.sell.form');
    }
}
