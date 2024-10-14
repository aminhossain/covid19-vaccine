<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VaccinationReminder extends Notification implements ShouldQueue
{
    use Queueable;

    protected $user;
    protected $scheduledDate;

    public function __construct($user, $scheduledDate)
    {
        $this->user = $user;
        $this->scheduledDate = $scheduledDate;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hello ' . $this->user->name . '!')
                    ->line('You have an upcoming COVID vaccination scheduled.')
                    ->line('Scheduled Date: ' . $this->scheduledDate)
                    ->line('Please make sure to be at the vaccine center on time.')
                    ->line('Thank you for helping stop the spread of COVID-19.');
    }
}
