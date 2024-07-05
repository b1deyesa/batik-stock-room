<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\User;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.dashboard.inventory.index', [
            'inventories' => Inventory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.dashboard.inventory.create', [
            'users' => User::where('role_id', 2)->get()->pluck('code', 'id')->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'user' => 'required'
        ]);
     
        $last_inventory_id = Inventory::latest()->first()?->id;
        $inventory_code = 'BT_'. sprintf('%03d', $last_inventory_id + 1);
        
        Inventory::create([
            'user_id' => $request->user,
            'code' => $inventory_code,
            'name' => $request->name, 
            'harga_beli' => $request->harga_beli, 
            'harga_jual' => $request->harga_jual, 
        ]);
        
        return redirect()->route('dashboard.inventory.index')->with('success', 'Successfuly add product');
    }

    /**
     * Display the specified resource.
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    public function updateMinimumStock(Request $request, Inventory $inventory)
    {
        $request->validate([
            'min_quantity' => 'required'
        ]);
        
        $inventory->update([
           'min_quantity' => $request->min_quantity 
        ]);
        
        return redirect()->route('dashboard.inventory.index')->with('success', 'Successfuly update minimum stock');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        
        return redirect()->route('dashboard.inventory.index')->with('success', 'Successfuly delete product');
    }
    
    public function report()
    {
        return view('page.dashboard.inventory.report', [
            'inventories' => Inventory::all()
        ]);
    }
}
