<?php

namespace App\Http\Controllers\Dashboard;

use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BuyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role->id == 2) {
            return view('page.dashboard.buy.index', [
                'transaksis' => Transaksi::where('type', 'Buy')->where('user_id', Auth::user()->id)->get()
            ]);
        }
        
        return view('page.dashboard.buy.index', [
            'transaksis' => Transaksi::where('type', 'Buy')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.dashboard.buy.create');
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
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $buy)
    {
        return view('page.dashboard.buy.edit', [
            'transaksi' => $buy
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $buy)
    {
        $buy->delete();
        
        return redirect()->route('dashboard.buy.index')->with('success', 'Successfuly delete transaction');
    }
    
    public function report(Request $request)
    {
        $transaksis = Transaksi::where('type', 'Buy');
        
        if (Auth::user()->role->id == 2) {
            $transaksis->where('user_id', Auth::user()->id);
        }
        
        
        if (request()->exists('from') && request()->exists('to')) {
            $request->merge([
                'from' => $request->from ?? date('Y-m-d'),
                'to' => $request->to ?? date('Y-m-d')
            ]);
            
            return view('page.dashboard.buy.report', [
                'transaksis' => $transaksis->whereBetween('created_at', [$request->from, Carbon::parse($request->to)->addDay()->format('Y-m-d')])->get()
            ]);
        }
                
        return view('page.dashboard.buy.report', [
            'transaksis' => $transaksis->get()
        ]);
    }
    
    public function generateReport(Request $request)
    {
        $transaksis = Transaksi::where('type', 'Buy');
        
        if (Auth::user()->role->id == 2) {
            $transaksis->where('user_id', Auth::user()->id);
        }
        
        $data = [
            'title' => 'Report Buy Batik Stock Room',
            'date' => date('Y-m-d'),
            'transaksis' => $transaksis->get()
        ]; 
        
        if (request()->exists('from') && request()->exists('to')) {
            $data = [
                'title' => 'Report Buy Batik Stock Room',
                'date' => $request->from .' sampai '. $request->to,
                'transaksis' => $transaksis->whereBetween('created_at', [$request->from, Carbon::parse($request->to)->addDay()->format('Y-m-d')])->get()
            ];
        }
    
        $pdf = PDF::loadView('page.dashboard.transaksi-report', $data);
       
        return $pdf->download('report-buy.pdf');
    }
}
