<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // Zobrazení formuláře pro objednávku
    public function create()
    {
        $services = Service::all();
        $user = Auth::user();
        return view('orders.create', compact('services', 'user'));
    }

    // Uložení objednávky
    public function store(Request $request)
    {
        try {
            Log::info('Začátek zpracování objednávky', [
                'request_data' => $request->all()
            ]);

            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|max:20',
                'message' => 'required',
                'address' => 'required|max:255',
                'service_id' => 'required|exists:services,id'
            ]);

            Log::info('Validace proběhla úspěšně', [
                'validated_data' => $validated
            ]);

            $validated['status'] = Order::STATUS_PENDING;
            
            // Pokud je uživatel přihlášený, propojíme objednávku s jeho účtem
            if (Auth::check()) {
                $validated['user_id'] = Auth::id();
            }
            
            Log::info('Připravuji vytvoření objednávky', [
                'validated_data' => $validated
            ]);

            $order = Order::create($validated);

            Log::info('Objednávka byla vytvořena', [
                'order_id' => $order->id,
                'order_data' => $order->toArray()
            ]);

            // Logování před odesláním e-mailu
            Log::info('Připravuji odeslání e-mailu administrátorovi', [
                'admin_address' => config('mail.admin.address'),
                'order_id' => $order->id,
                'order_data' => $order->toArray()
            ]);

            // Odeslání emailu administrátorovi
            Mail::to(config('mail.admin.address'))->send(new \App\Mail\NewOrder($order));

            Log::info('E-mail byl úspěšně odeslán');

            return redirect()->route('thank-you')
                ->with('success', 'Vaše objednávka byla úspěšně přijata. Budeme Vás kontaktovat.');
        } catch (\Exception $e) {
            Log::error('Chyba při ukládání objednávky', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all()
            ]);
            throw $e;
        }
    }

    // Zobrazení potvrzení objednávky
    public function thankYou()
    {
        return view('orders.success');
    }

    /**
     * Zobrazí seznam objednávek přihlášeného uživatele
     */
    public function index()
    {
        $orders = Order::with('service')
            ->where('email', Auth::user()->email)
            ->latest()
            ->paginate(5);
            
        return view('orders.index', compact('orders'));
    }

    // Zobrazení detailu objednávky
    public function show(Order $order)
    {
        // Kontrola, zda je objednávka patří přihlášenému uživateli
        if ($order->email !== Auth::user()->email) {
            abort(403);
        }
        
        // Načteme vztah ke službě
        $order->load('service');
        
        return view('orders.show', compact('order'));
    }

    /**
     * Smaže objednávku
     */
    public function destroy(Order $order)
    {
        // Kontrola, zda objednávka patří přihlášenému uživateli
        if ($order->email !== Auth::user()->email) {
            abort(403);
        }

        // Kontrola, zda lze objednávku smazat (např. pouze objednávky ve stavu pending)
        if ($order->status !== Order::STATUS_PENDING) {
            return back()->with('error', 'Tuto objednávku již nelze smazat.');
        }

        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Objednávka byla úspěšně smazána.');
    }
}