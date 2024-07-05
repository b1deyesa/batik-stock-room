<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Transaksi;
use App\Models\Requestion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RequestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role->id == 2) {
            $requestions = Requestion::where('user_id', Auth::user()->id)->where('status', NULL)->get();
        } else {
            $requestions = Requestion::where('status', NULL)->get();
        }
    
        return view('page.dashboard.requestion.index', [
            'requestions' => $requestions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 
    }

    /**
     * Display the specified resource.
     */
    public function show(Requestion $requestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Requestion $requestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Requestion $requestion)
    {
        if ($request->status == 0) {
            $requestion->update([
                'user_id' => Auth::user()->id,
                'status' => false,
                'description' => $request->description
            ]);
        } else {
            $requestion->update([
                'user_id' => Auth::user()->id,
                'status' => true
            ]);
            
            foreach ($requestion->transaksi->detailTransaksis as $detailTransaksi) {
                $quantity = (int) $detailTransaksi->inventory->quantity + (int) $detailTransaksi->quantity;
                $detailTransaksi->inventory->update([
                    'quantity' => $quantity
                ]);
            }
        }
        
        return redirect()->route('dashboard.requestion.index')->with('success', 'Successfuly update request status');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Requestion $requestion)
    {
        //
    }
}
