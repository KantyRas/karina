<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DemandeTravauxValider extends Notification
{
    use Queueable;
    protected $demandetravaux;
    public function __construct($demandetravaux)
    {
        $this->demandetravaux = $demandetravaux;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'message' => "La demande Travaux/nº". str_pad($this->demandetravaux->iddemandetravaux, 4, '0', STR_PAD_LEFT). " a été validée par ". auth()->user()->username,
            'demandetravaux_id' => $this->demandetravaux->iddemandetravaux,
            'validated_by' => auth()->user()->username,
        ];
    }
}
