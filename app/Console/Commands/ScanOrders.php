<?php

namespace App\Console\Commands;

use App\Order;
use App\Pharmacy;
use Illuminate\Console\Command;

class ScanOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scan:new-orders-and-assign-them-pharmacy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'scan the new ​ orders and assign them to the highest priority pharmacy';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $newOrders = Order::where('status', 'new')->get();
        foreach ($newOrders as $order){
            $pharmacy = Pharmacy::where('area_id', $order->address->area->id)->orderBy('priority', 'desc')->first();
            if(!$pharmacy->clients->contains($order->creator)) $pharmacy->clients()->save($order->creator);
            $pharmacy->orders()->save($order);
            $order->status = 'processing';
            $order->save();
        }
    }
}
