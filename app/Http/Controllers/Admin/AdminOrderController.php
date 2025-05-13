<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderStatusUpdate;
use App\Mail\OrderConfirmed;
use App\Mail\OrderRejected;

// Controller pro správu objednávek v administraci
class AdminOrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index()
    {
        $orders = Order::with('service')
            ->latest()
            ->paginate(10);
            
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        return view('admin.orders.create');
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'address' => 'required|string|max:255',
            'status' => ['required', 'in:' . implode(',', [Order::STATUS_PENDING, Order::STATUS_COMPLETED, Order::STATUS_CANCELLED])]
        ]);

        $order = Order::create($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Objednávka byla úspěšně vytvořena.');
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'message' => 'required|string',
            'service_id' => 'required|exists:services,id',
            'status' => ['required', 'in:' . implode(',', [Order::STATUS_PENDING, Order::STATUS_COMPLETED, Order::STATUS_CANCELLED])],
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Objednávka byla úspěšně upravena.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return back()->with('success', 'Objednávka byla úspěšně smazána.');
    }

    /**
     * Complete the specified order.
     */
    public function complete(Order $order)
    {
        $order->update(['status' => Order::STATUS_COMPLETED]);
        
        // Načteme vztah service
        $order->load('service');
        
        // Odeslání e-mailu zákazníkovi
        Mail::to($order->email)->send(new OrderConfirmed($order));

        return redirect()->route('admin.orders.index')
            ->with('success', 'Objednávka byla úspěšně dokončena.');
    }

    /**
     * Cancel the specified order.
     */
    public function cancel(Order $order)
    {
        $order->update(['status' => Order::STATUS_CANCELLED]);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Objednávka byla úspěšně zrušena.');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:' . implode(',', [
                Order::STATUS_PENDING,
                Order::STATUS_PROCESSING,
                Order::STATUS_COMPLETED,
                Order::STATUS_CANCELLED
            ])],
        ]);

        $oldStatus = $order->status;
        $order->update($validated);

        // Odeslání emailu podle změny stavu
        if ($oldStatus !== $order->status) {
            switch ($order->status) {
                case Order::STATUS_COMPLETED:
                    Mail::to($order->email)->send(new OrderConfirmed($order));
                    break;
                case Order::STATUS_CANCELLED:
                    Mail::to($order->email)->send(new OrderRejected($order));
                    break;
                default:
                    Mail::to($order->email)->send(new OrderStatusUpdate($order));
            }
        }

        return redirect()->route('admin.orders.index')
            ->with('success', 'Stav objednávky byl úspěšně aktualizován.');
    }
} 