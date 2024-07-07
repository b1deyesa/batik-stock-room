<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Returned;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReturnedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {        
        $transaksis = Transaksi::whereDoesntHave('returneds', function ($query) {
            $query->where('status', true); })->orWhereHas('returneds', function ($query) {
            $query->where('status', false)
                  ->whereNull('id'); })->get();
                  
        if (Auth::user()->role->id == 2) {
            return view('page.dashboard.returned.index', [
                'transaksis' => $transaksis->where('user_id', Auth::user()->id),
                'returneds' => Returned::where('user_id', Auth::user()->id)->get()
            ]);
        }
        
        return view('page.dashboard.returned.index', [
            'transaksis' => $transaksis,
            'returneds' => Returned::all()
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
        Returned::create([
            'user_id' => Auth::user()->id,
            'transaksi_id' => $request->transaksi,
            'status' => true,
            'description' => $request->description,
        ]);
        
        return redirect()->route('dashboard.returned.index')->with('success', 'Request return product');
    }

    /**
     * Display the specified resource.
     */
    public function show(Returned $returned)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Returned $returned)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Returned $returned)
    {
        $returned->update([
            'isReturn' => $request->isReturn
        ]);
        
        return redirect()->route('dashboard.returned.index')->with('success', 'Update return product');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Returned $returned)
    {
        //
    }
}
