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
            
        return view('page.dashboard.index', [
            'inventories' => Inventory::all(),
            'BestSellers' => $BestSellers,
            'SellHistory' => $SellHistory
        ]);
    }
}
