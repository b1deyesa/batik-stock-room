<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\Transaksi;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Charts\BestSellerChart;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index(): View
    {
        $BestSellers = Customer::join('transaksis', 'customers.id', '=', 'transaksis.user_id')
            ->where('transaksis.type', 'Sell')
            ->select('customers.id', 'customers.first_name', DB::raw('SUM(transaksis.grandtotal) as total_purchase'))
            ->groupBy('customers.id', 'customers.first_name')
            ->orderBy('total_purchase', 'desc')
            ->take(5)
            ->get();
        
        $SellHistory = Transaksi::where('created_at', '>=', Carbon::now()->subDays(5)->startOfDay())
            ->select(DB::raw("DATE_FORMAT(created_at, '%d/%m') as date"), DB::raw('SUM(grandtotal) as total_transaksi'))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d/%m')"))
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%d/%m')"))
            ->get();
        
        $inventroies = Inventory::all();
        
        if (Auth::user()->role->id == 2) {
            $inventroies = Inventory::where('user_id', Auth::user()->id)->get();
        }
        
        return view('page.dashboard.index', [
            'inventories' => $inventroies,
            'BestSellers' => $BestSellers,
            'SellHistory' => $SellHistory
        ]);
    }
}
