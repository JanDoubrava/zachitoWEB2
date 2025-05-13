<?php

namespace App\Mail\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminContactConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $name;

    /**
     * Vytvoření nové instance
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Sestavení zprávy
     */
    public function build()
    {
        return $this->subject('Potvrzení přijetí vaší zprávy - Čalounictví ZACHITO')
                    ->view('emails.contact-form-confirmation');
    }
} 