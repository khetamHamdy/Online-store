<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    protected $order;
    protected $billing;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [ 'database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $order = $this->order;

        $line1 = "{$order->customer_name} / {$order->customer_email} / {$order->customer_mobile} has placed a new order (#{$order->id}) on your store";
        return (new MailMessage)
            ->from('invoices@khetamHamdy.com', 'khetamHamdy Billing Account')
            ->subject('New Order #' . $this->order->id)
            ->greeting("Hi $notifiable->name,")
            ->line($line1)
            ->action('View Order', url('/admin/users/' . $order->user_id . '/orders'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        $order = $this->order;
        // $billing = $order->address()->where('type', '=', '1')->first();

        $line1 = "{$order->customer_name} / {$order->customer_email} / {$order->customer_mobile} has placed a new order (#{$order->id}) on your store";

        return [
            // Basic Notification Data
            'title' => 'New Order #' . $this->order->id,
            'body' => $line1,
            'image' => '',
            'url' => url('/admin/users/' . $order->user_id . '/orders'),
            // Custom Data
            'order' => $this->order,
        ];

    }

    public function toBroadcast($notifiable)
    {
        $order = $this->order;
        // $billing = $order->address()->where('type', '=', '1')->first();
        $line1 = "{$order->customer_name} / {$order->customer_email} / {$order->customer_mobile} has placed a new order (#{$order->id}) on your store";

        return new BroadcastMessage([
            'title' => 'New Order #' . $this->order->id,
            'body' => $line1,
            'image' => '',
            'url' => url('/admin/users/' . $order->user_id . '/orders'),
            'order' => $this->order,
            'count_orders' => Order::count(),
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
