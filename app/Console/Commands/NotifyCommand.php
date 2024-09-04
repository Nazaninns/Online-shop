<?php

namespace App\Console\Commands;

use App\Models\Customer;
use App\Models\Product;
use App\Notifications\ProductsNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class NotifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:notify-customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email about 5 most discounted product to customers that purchased in last month';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $products = Product::where('discount_id', '!=', null)->with('discount')->get();
        $sortedProducts = $products->sortByDesc(function ($product) {
            return $product->discount->percent;
        })->take(5);
        $customers = Customer::whereHas('orders', function ($query) {
            $query->where('created_at', '>=', Carbon::now()->subMonth());
        })->get();
        $notification = new ProductsNotification($sortedProducts);
        Notification::send($customers, $notification);

    }
}
