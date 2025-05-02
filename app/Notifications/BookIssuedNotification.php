<?php


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class BookIssuedNotification extends Notification
{
    use Queueable;

    protected $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        // You can send notifications via mail, database, etc.
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('A new book has been reserved by a user and is awaiting your approval.')
            ->action('Approve Reservation', url('/librarian/issue-book/' . $this->reservation->id))
            ->line('Please approve or reject the reservation.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'reservation_id' => $this->reservation->id,
            'book_title' => $this->reservation->book->title,
            'status' => 'pending',
        ];
    }
}
