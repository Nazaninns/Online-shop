<?php

namespace App\Observers;

use App\Models\Product;
use App\Notifications\AlarmNotification;
use Illuminate\Support\Facades\Notification;


class AlarmObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if ($product->getOriginal('quantity') == 0 && $product->getAttribute('quantity') > 0) {
            $notification = new AlarmNotification($product);
            $customers = $product->customerWithAlarm;
            Notification::send($customers, $notification);
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
