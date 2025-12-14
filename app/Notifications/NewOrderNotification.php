<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class NewOrderNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // optional: database, mail, sms, etc.
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('New Laundry Order')
                    ->line('A new order has been placed.')
                    ->line('Order ID: '.$this->order->id)
                    ->action('View Order', url('/admin/orders'))
                    ->line('Thank you for using Washam!');
    }

    public function toArray($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'user_id' => $this->order->user_id,
            'total' => $this->order->total,
            'status' => $this->order->status,
        ];
    }
}
