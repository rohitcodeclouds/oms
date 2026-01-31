<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
     public function index()
    {
        $totalOrders = Order::count();

        $totalRevenue = Order::where('status', '!=', 'cancelled')
            ->sum('total_amount');

        $totalCustomers = User::where('role', 'customer')->count();

        $recentOrders = Order::with('user')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'totalCustomers',
            'recentOrders'
        ));
    }
}
