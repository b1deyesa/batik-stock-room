<?php

namespace App\Livewire\Dashboard\Buy;

use App\Models\User;
use Livewire\Component;
use App\Models\Inventory;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class Update extends Component
{
    public Transaksi $transaksi;
    
    public $no_transaksi;
    public $tanggal;
    public $user;
    public $total;
    
    public $batik;
    public $name;
    public $harga_jual;
    public $quantity;
    
    public $anggotas;
    public $inventories;
    public $products = [];
    
    public function mount()
    {
        $this->no_transaksi = $this->transaksi->code;
        $this->tanggal = $this->transaksi->created_at->format('d F Y');        
        $this->user = $this->transaksi->user->id;        
        $this->total = $this->transaksi->grandtotal;     
           
        $this->anggotas = User::where('role_id', 2)->get()->pluck('code', 'id')->toArray();
        $this->inventories = Inventory::all()->pluck('code', 'id')->toArray();
        
        foreach ($this->transaksi->detailTransaksis as $detailTransaksi) {
            $this->products[] = [
                'id' => $detailTransaksi->inventory->id,
                'code' => $detailTransaksi->inventory->code,
                'name' => $detailTransaksi->inventory->name,
                'user' => $detailTransaksi->inventory->user->code,
                'harga_jual' => $detailTransaksi->inventory->harga_jual,
                'quantity' => $detailTransaksi->quantity,
                'total' => $detailTransaksi->quantity * $detailTransaksi->inventory->harga_jual
            ];
        }
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
            'user' => 'required',
            'total' => 'required|not_in:0'
        ]);
        
        $this->transaksi->update([
           'grandtotal' => $this->total 
        ]);
        
        $this->transaksi->DetailTransaksis()->delete();
        
        foreach ($this->products as $product) {
            DetailTransaksi::create([
               'transaksi_id' => $this->transaksi->id, 
               'inventory_id' => $product['id'], 
               'quantity' => $product['quantity'] 
            ]);
        }
        
        return redirect()->route('dashboard.buy.index')->with('success', 'Transaction successfuly update');
    }
    
    public function render()
    {
        return view('livewire.dashboard.buy.form');
    }
}
