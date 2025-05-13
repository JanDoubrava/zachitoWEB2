<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminContactRequest;
use App\Mail\Admin\AdminContactConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

// Kontroler pro správu kontaktního formuláře
class AdminContactController extends Controller
{
    /**
     * Zobrazení kontaktního formuláře
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Zpracování odeslaného formuláře
     */
    public function store(AdminContactRequest $request)
    {
        // Rate limiting - max 3 pokusy za hodinu
        $executed = RateLimiter::attempt(
            'contact-form:' . $request->ip(),
            3,
            function() use ($request) {
                $data = $request->validated();

                // Odeslání emailu administrátorovi
                Mail::to(config('mail.admin.address'))
                    ->queue(new ContactForm($data));

                // Odeslání potvrzení odesílateli
                Mail::to($data['email'])
                    ->queue(new AdminContactConfirmation($data['name']));

                return true;
            },
            60 * 60 // 1 hodina
        );

        if (!$executed) {
            return back()
                ->withInput()
                ->withErrors(['limit' => 'Překročili jste limit počtu odeslaných zpráv. Zkuste to prosím později.']);
        }

        return redirect()
            ->route('contact')
            ->with('success', 'Vaše zpráva byla úspěšně odeslána. Na váš email jsme zaslali potvrzení.');
    }
} 