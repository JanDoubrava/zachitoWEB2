<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Review;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    /**
     * Zobrazí administrační dashboard
     */
    public function index(): View
    {
        $ordersCount = Order::count();
        $servicesCount = Service::count();
        $galleryCount = Gallery::count();
        $usersCount = User::count();
        $recentOrders = Order::with('service')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'ordersCount',
            'servicesCount',
            'galleryCount',
            'usersCount',
            'recentOrders'
        ));
    }
} 