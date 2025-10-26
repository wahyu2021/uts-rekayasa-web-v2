<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard admin.
     *
     * Method ini mengumpulkan data statistik seperti total produk, kategori, pesanan, dan pendapatan.
     * Method ini juga menyiapkan data untuk chart penjualan dalam 7 hari terakhir.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');

        $salesData = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_price) as total')
        )
            ->where('status', 'completed')
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $dates = [];
        $totals = [];
        $period = Carbon::now()->subDays(6)->startOfDay()->toPeriod(Carbon::now()->endOfDay());

        foreach ($period as $date) {
            $formattedDate = $date->format('Y-m-d');
            $dates[] = $date->format('D, M j');
            $sale = $salesData->firstWhere('date', $formattedDate);
            $totals[] = $sale ? $sale->total : 0;
        }

        $chartData = [
            'labels' => $dates,
            'data' => $totals,
        ];

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'totalRevenue',
            'chartData'
        ));
    }
}
