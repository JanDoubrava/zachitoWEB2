<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;

// Controller pro správu služeb v administraci
class AdminServiceController extends Controller
{
    /**
     * Zobrazí seznam všech služeb
     */
    public function index(): View
    {
        $services = Service::query()
            ->withCount('orders')
            ->latest()
            ->paginate(10);

        return view('admin.services.index', [
            'services' => $services
        ]);
    }

    /**
     * Zobrazí formulář pro přidání nové služby
     */
    public function create(): View
    {
        return view('admin.services.create');
    }

    /**
     * Uloží novou službu
     */
    public function store(ServiceRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = uniqid() . '_' . time() . '.' . $extension;
                
                // Zpracování obrázku pomocí Intervention Image
                $image = Image::make($file);
                
                // Resize obrázku na maximální rozměry
                $image->resize(1200, 800, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                // Uložení obrázku do storage/app/public/services
                $path = 'services/' . $filename;
                Storage::disk('public')->put($path, $image->encode());
                $validated['image'] = $path;
                
                // Logování pro debug
                Log::info('Obrázek služby byl úspěšně uložen', [
                    'path' => $validated['image'],
                    'exists' => Storage::disk('public')->exists($path)
                ]);
            } catch (\Exception $e) {
                Log::error('Chyba při ukládání obrázku služby', [
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]);
                return redirect()
                    ->route('admin.services.create')
                    ->with('error', 'Nepodařilo se uložit obrázek: ' . $e->getMessage())
                    ->withInput();
            }
        }

        $service = Service::create($validated);
        
        // Logování po vytvoření záznamu v databázi
        Log::info('Služba byla vytvořena', [
            'service_id' => $service->id,
            'image_path' => $service->image,
            'image_url' => Storage::disk('public')->url($service->image)
        ]);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Služba byla úspěšně vytvořena.');
    }

    /**
     * Zobrazí formulář pro úpravu služby
     */
    public function edit(Service $service): View
    {
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Aktualizuje službu
     */
    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('image')) {
            // Smazat starý obrázek
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }

            try {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = uniqid() . '_' . time() . '.' . $extension;
                
                // Zpracování obrázku pomocí Intervention Image
                $image = Image::make($file);
                
                // Resize obrázku na maximální rozměry
                $image->resize(1200, 800, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                
                // Uložení obrázku do storage/app/public/services
                $path = 'services/' . $filename;
                Storage::disk('public')->put($path, $image->encode());
                $validated['image'] = $path;
                
                // Logování pro debug
                Log::info('Obrázek služby byl úspěšně uložen', [
                    'path' => $validated['image'],
                    'exists' => Storage::disk('public')->exists($path)
                ]);
            } catch (\Exception $e) {
                Log::error('Chyba při ukládání obrázku služby', [
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]);
                return redirect()
                    ->route('admin.services.edit', $service)
                    ->with('error', 'Nepodařilo se uložit obrázek: ' . $e->getMessage())
                    ->withInput();
            }
        }

        $service->update($validated);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Služba byla úspěšně aktualizována.');
    }

    /**
     * Smaže službu
     */
    public function destroy(Service $service): RedirectResponse
    {
        // Smazat obrázek
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        
        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Služba byla úspěšně smazána.');
    }
} 