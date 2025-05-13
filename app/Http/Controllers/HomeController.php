<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Service;
use Illuminate\View\View;
use Illuminate\Http\Request;

// Kontroler pro správu veřejné části webu
class HomeController extends Controller
{
    /**
     * Zobrazí úvodní stránku
     */
    public function index(): View
    {
        $services = Service::query()
            ->active()
            ->latest()
            ->take(8)
            ->get();
        $gallery = Gallery::latest()->take(6)->get();
        return view('pages.home', compact('services', 'gallery'));
    }

    /**
     * Zobrazí stránku O nás
     */
    public function about(): View
    {
        return view('pages.about');
    }

    /**
     * Zobrazí stránku s referencemi
     */
    public function references(): View
    {
        $gallery = Gallery::query()
            ->active()
            ->where('category', 'reference')
            ->latest()
            ->paginate(12);

        return view('pages.references', [
            'gallery' => $gallery
        ]);
    }

    /**
     * Zobrazí stránku s galerií
     */
    public function gallery(): View
    {
        $items = Gallery::latest()->paginate(12);
        return view('gallery.index', compact('items'));
    }

    /**
     * Zobrazí seznam služeb
     */
    public function services(): View
    {
        $services = Service::query()
            ->active()
            ->orderBy('name')
            ->take(20)
            ->get();
        return view('services.index', compact('services'));
    }

    /**
     * Zobrazí detail služby
     */
    public function service(Service $service): View
    {
        return view('services.show', compact('service'));
    }

    /**
     * Zobrazí kontaktní stránku
     */
    public function contact(): View
    {
        return view('pages.contact');
    }
} 