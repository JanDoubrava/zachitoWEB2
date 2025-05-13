<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// Mailová třída pro notifikaci o změně stavu objednávky
class OrderStatusUpdate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Instance objednávky
     */
    public Order $order;

    /**
     * Vytvoří novou instanci emailu
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Sestaví email
     */
    public function build(): self
    {
        return $this
            ->subject('Aktualizace stavu objednávky #' . $this->order->id)
            ->view('mail.order-status-update');
    }
} 