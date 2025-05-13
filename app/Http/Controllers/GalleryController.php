<?php
namespace App\Http\Controllers;

use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Zobrazení galerie
     */
    public function index(): View
    {
        $items = GalleryItem::where('is_active', true)->get();
        return view('gallery.index', compact('items'));
    }

    /**
     * Zobrazení detailu položky
     */
    public function show(GalleryItem $item)
    {
        return view('gallery.show', compact('item'));
    }
}
