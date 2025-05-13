<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Zobrazí seznam služeb
     */
    public function index(): View
    {
        $services = Service::where('is_active', true)->get();
        return view('services.index', compact('services'));
    }

    /**
     * Zobrazí detail služby
     */
    public function show(Service $service): View
    {
        return view('services.show', compact('service'));
    }
} 