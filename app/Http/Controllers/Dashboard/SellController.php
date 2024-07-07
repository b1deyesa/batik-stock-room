<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Http\Controllers\Controller;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('page.dashboard.sell.index', [
            'transaksis' => Transaksi::where('type', 'Sell')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('page.dashboard.sell.create');
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
    public function edit(Transaksi $sell)
    {
        return view('page.dashboard.sell.edit', [
            'transaksi' => $sell
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
    public function destroy(Transaksi $sell)
    {
        $sell->delete();
        
        return redirect()->route('dashboard.sell.index')->with('success', 'Successfuly delete transaction');
    }
    
    public function report(Request $request)
    {
        if (request()->exists('from') && request()->exists('to')) {
            $request->merge([
                'from' => $request->from ?? date('Y-m-d'),
                'to' => $request->to ?? date('Y-m-d')
            ]);
            
            return view('page.dashboard.sell.report', [
                'transaksis' => Transaksi::where('type', 'Sell')->whereBetween('created_at', [$request->from, Carbon::parse($request->to)->addDay()->format('Y-m-d')])->get()
            ]);
        }
        
        return view('page.dashboard.sell.report', [
            'transaksis' => Transaksi::where('type', 'Sell')->get()
        ]);
    }
    
    public function generateReport(Request $request)
    {
        $data = [
            'title' => 'Report Sell Batik Stock Room',
            'date' => date('Y-m-d'),
            'transaksis' => Transaksi::where('type', 'Sell')->get()
        ]; 
        
        if (request()->exists('from') && request()->exists('to')) {
            $data = [
                'title' => 'Report Sell Batik Stock Room',
                'date' => $request->from .' sampai '. $request->to,
                'transaksis' => Transaksi::where('type', 'Sell')->whereBetween('created_at', [$request->from, Carbon::parse($request->to)->addDay()->format('Y-m-d')])->get()
            ];
        }
    
        $pdf = PDF::loadView('page.dashboard.transaksi-report', $data);
       
        return $pdf->download('report-sell.pdf');
    }
}
