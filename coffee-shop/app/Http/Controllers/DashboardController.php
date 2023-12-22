<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $revenueThisMonth = Payment::whereMonth('created_at', now()->month)->sum('amount');
        $completedOrdersThisMonth = Payment::whereMonth('created_at', now()->month)->where('status', 'paid')->count();
        $bestSellingProduct = Product::withCount('paymentDetails')->orderByDesc('payment_details_count')->first();
        $topContributor = User::withSum('payments', 'amount')->orderByDesc('payments_sum_amount')->first();

        return view('admin.dashboard', compact('revenueThisMonth', 'completedOrdersThisMonth', 'bestSellingProduct', 'topContributor'));
    }

    public function getData()
    {
        $productRevenue = DB::table('payments')
            ->join('payment_details', 'payments.id', '=', 'payment_details.payment_id')
            ->join('products', 'payment_details.product_id', '=', 'products.id')
            ->select('products.name', DB::raw('SUM(payment_details.quantity * products.price) as revenue'))
            ->groupBy('products.name')
            ->get();

        $dailyRevenue = Payment::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(amount) as revenue'))
            ->whereMonth('created_at', now()->month)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->get();

        return response()->json(compact('dailyRevenue','productRevenue'));
    }
}
