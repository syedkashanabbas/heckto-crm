<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmployeeClockedOut extends Notification
{
    use Queueable;

    protected $user;
    protected $workedHours;
    protected $workedMinutes;

    public function __construct($user, $workedHours, $workedMinutes)
    {
        $this->user = $user;
        $this->workedHours = $workedHours;
        $this->workedMinutes = $workedMinutes;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Employee Clocked Out')
            ->greeting('Hello Admin,')
            ->line($this->user->name . ' has clocked out.')
            ->line('Email: ' . $this->user->email)
            ->line('Worked Time: ' . $this->workedHours . 'h ' . str_pad($this->workedMinutes, 2, '0', STR_PAD_LEFT) . 'm')
            ->line('Time: ' . now()->format('d M Y h:i A'))
            ->action('View Attendance', url('/admin/attendance'))
            ->line('— Heckto HRM System');
    }

    public function toDatabase($notifiable)
    {
        return [
            'user_name' => $this->user->name,
            'user_email' => $this->user->email,
            'worked_hours' => $this->workedHours,
            'worked_minutes' => $this->workedMinutes,
            'clock_out_time' => now()->toDateTimeString(),
            'message' => $this->user->name . ' clocked out after ' . $this->workedHours . 'h ' . $this->workedMinutes . 'm',
        ];
    }
}
