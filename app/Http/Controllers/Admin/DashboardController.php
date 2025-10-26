<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Stat Cards
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_price');

        // Sales Chart Data (Last 7 Days)
        $salesData = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_price) as total')
        )
        ->where('status', 'completed')
        ->where('created_at', '>=', Carbon::now()->subDays(6))
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        // Format data for Chart.js
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
