<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

// Controller pro správu galerie v administraci
class AdminGalleryController extends Controller
{
    private $uploadPath = 'gallery';

    /**
     * Zobrazí seznam všech obrázků v galerii
     */
    public function index(): View
    {
        $gallery = Gallery::query()
            ->latest()
            ->paginate(12);

        return view('admin.gallery.index', [
            'gallery' => $gallery
        ]);
    }

    /**
     * Zobrazí formulář pro přidání nového obrázku
     */
    public function create(): View
    {
        return view('admin.gallery.create', [
            'categories' => Gallery::CATEGORIES
        ]);
    }

    /**
     * Uloží nový obrázek do galerie
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();
                
                Log::info('Začátek ukládání obrázku', [
                    'original_name' => $image->getClientOriginalName(),
                    'filename' => $filename,
                    'size' => $image->getSize(),
                    'mime_type' => $image->getMimeType()
                ]);

                // Zajistíme, že složka existuje
                if (!Storage::disk('public')->exists('gallery')) {
                    Storage::disk('public')->makeDirectory('gallery');
                    Log::info('Vytvořena složka gallery');
                }

                // Uložíme obrázek
                $path = $image->storeAs('gallery', $filename, 'public');
                
                if (!$path) {
                    throw new \Exception('Nepodařilo se uložit obrázek');
                }

                Log::info('Obrázek byl uložen', [
                    'path' => $path,
                    'exists' => Storage::disk('public')->exists($path),
                    'full_path' => Storage::disk('public')->path($path),
                    'url' => Storage::disk('public')->url($path)
                ]);

                // Vytvoříme nový záznam v galerii
                $gallery = Gallery::create([
                    'title' => $request->title,
                    'description' => $request->description,
                    'image' => $path,
                    'is_active' => true
                ]);

                Log::info('Záznam v galerii byl vytvořen', [
                    'gallery_id' => $gallery->id,
                    'image_path' => $gallery->image,
                    'image_url' => $gallery->image_url,
                    'storage_exists' => Storage::disk('public')->exists($gallery->image),
                    'storage_path' => Storage::disk('public')->path($gallery->image),
                    'public_url' => Storage::disk('public')->url($gallery->image)
                ]);

                return redirect()->route('admin.gallery.index')
                    ->with('success', 'Obrázek byl úspěšně přidán.');
            }
        } catch (\Exception $e) {
            Log::error('Chyba při ukládání obrázku', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Nepodařilo se uložit obrázek. Zkuste to prosím znovu.');
        }
    }

    /**
     * Zobrazí formulář pro úpravu obrázku
     */
    public function edit(Gallery $gallery): View
    {
        return view('admin.gallery.edit', [
            'gallery' => $gallery,
            'categories' => Gallery::CATEGORIES
        ]);
    }

    /**
     * Aktualizuje obrázek v galerii
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            if ($request->hasFile('image')) {
                // Smažeme starý obrázek
                if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                    Storage::disk('public')->delete($gallery->image);
                    Log::info('Starý obrázek byl smazán', [
                        'gallery_id' => $gallery->id,
                        'old_image' => $gallery->image
                    ]);
                }

                $image = $request->file('image');
                $filename = time() . '_' . $image->getClientOriginalName();
                
                // Zajistíme, že složka existuje
                if (!Storage::disk('public')->exists('gallery')) {
                    Storage::disk('public')->makeDirectory('gallery');
                    Log::info('Vytvořena složka gallery');
                }

                // Uložíme nový obrázek
                $path = $image->storeAs('gallery', $filename, 'public');
                
                if (!$path) {
                    throw new \Exception('Nepodařilo se uložit obrázek');
                }

                Log::info('Nový obrázek byl uložen', [
                    'gallery_id' => $gallery->id,
                    'path' => $path,
                    'exists' => Storage::disk('public')->exists($path),
                    'full_path' => Storage::disk('public')->path($path),
                    'url' => Storage::disk('public')->url($path)
                ]);

                $gallery->image = $path;
            }

            $gallery->title = $request->title;
            $gallery->description = $request->description;
            $gallery->save();

            Log::info('Obrázek byl úspěšně aktualizován', [
                'gallery_id' => $gallery->id,
                'image_path' => $gallery->image,
                'image_url' => $gallery->image_url,
                'storage_exists' => Storage::disk('public')->exists($gallery->image),
                'storage_path' => Storage::disk('public')->path($gallery->image),
                'public_url' => Storage::disk('public')->url($gallery->image)
            ]);

            return redirect()->route('admin.gallery.index')
                ->with('success', 'Obrázek byl úspěšně aktualizován.');
        } catch (\Exception $e) {
            Log::error('Chyba při aktualizaci obrázku', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Nepodařilo se aktualizovat obrázek. Zkuste to prosím znovu.');
        }
    }

    /**
     * Smaže obrázek z galerie
     */
    public function destroy(Gallery $gallery): RedirectResponse
    {
        // Smazat obrázek
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        
        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Obrázek byl úspěšně smazán.');
    }
} 