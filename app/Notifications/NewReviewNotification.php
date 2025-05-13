<?php

namespace App\Notifications;

use App\Models\Review;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReviewNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Review $review
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nová recenze ke schválení')
            ->greeting('Dobrý den,')
            ->line('Na webu byla přidána nová recenze od uživatele ' . $this->review->name)
            ->line('Hodnocení: ' . str_repeat('⭐', $this->review->rating))
            ->line('Text recenze:')
            ->line($this->review->text)
            ->action('Zobrazit recenzi', route('admin.reviews.index'))
            ->line('Děkujeme za vaši pozornost.');
    }
} 