<?php

namespace App\Console\Commands;

use App\Models\Cart;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class ClearCarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clear:carts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'clear carts every 6 hours';

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
     * @return int
     */
    public function handle()
    {
       $items = Cart::where('created_at', '<',
           Carbon::now()->subHours(6)->toDateTimeString()
       )->delete();

       foreach($items as $one){
           $one->delete();
       }
    }
}
