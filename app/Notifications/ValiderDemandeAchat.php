<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ValiderDemandeAchat extends Notification
{
    use Queueable;
    protected $demandeachat;

    /**
     * Create a new notification instance.
     */
    public function __construct($demandeachat)
    {
        $this->demandeachat = $demandeachat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => "Demande d'achat validée et livrée par {$this->demandeachat->receveur->username}",
            'demandeachat_id' => $this->demandeachat->iddemandeachat,
            'title' => "Achat/nº" . str_pad($this->demandeachat->iddemandeachat, 4, '0', STR_PAD_LEFT),
        ];
    }
}
