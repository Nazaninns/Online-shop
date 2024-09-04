<?php

namespace App\Listeners;

use App\Enum\OrderStatusEnum;
use App\Events\OrderStatusChangeEvent;
use App\Notifications\ChangeOrderStatusNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class OrderStatusChangeListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderStatusChangeEvent $event): void
    {
        $order = $event->order;
        $newState = match ($order->status) {
            OrderStatusEnum::PAID => OrderStatusEnum::PREPARING,
            OrderStatusEnum::PREPARING => OrderStatusEnum::SHIPPING,
            OrderStatusEnum::SHIPPING => OrderStatusEnum::DELIVERED,
            default => null,
        };

        if ($newState) {

            $order->transitionTo($newState);

            $customer = $order->customer;
            $notification = new ChangeOrderStatusNotification($order);
            Notification::send($customer, $notification);
        }
    }
}
