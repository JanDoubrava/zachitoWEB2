<?php

namespace App\Notifications;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReviewStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Review $review,
        protected string $status
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->greeting('Dobrý den ' . $this->review->name . ',');

        if ($this->status === 'approved') {
            $message->subject('Vaše recenze byla schválena')
                ->line('Vaše recenze byla úspěšně schválena a nyní je viditelná na našem webu.')
                ->line('Děkujeme za vaši zpětnou vazbu.')
                ->action('Zobrazit recenze', route('reviews.index'));
        } else {
            $message->subject('Vaše recenze byla zamítnuta')
                ->line('Je nám líto, ale vaše recenze byla zamítnuta.')
                ->line('Pokud máte zájem, můžete zkusit přidat novou recenzi.')
                ->action('Přidat novou recenzi', route('reviews.create'));
        }

        return $message->line('Děkujeme za váš zájem.');
    }
} 