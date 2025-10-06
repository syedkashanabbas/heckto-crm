<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmployeeClockedIn extends Notification
{
    use Queueable;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Employee Clocked In')
            ->greeting('Hello Admin,')
            ->line($this->user->name . ' has clocked in.')
            ->line('Email: ' . $this->user->email)
            ->line('Time: ' . now()->format('d M Y h:i A'))
            ->action('View Attendance', url('/admin/attendance'))
            ->line('— Heckto HRM System');
    }

    public function toDatabase($notifiable)
    {
        return [
            'user_name' => $this->user->name,
            'user_email' => $this->user->email,
            'clock_in_time' => now()->toDateTimeString(),
            'message' => $this->user->name . ' clocked in at ' . now()->format('h:i A'),
        ];
    }
}
