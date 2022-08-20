<?php

namespace App\Console\Commands;

use App\Mail\DeleteOrder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PaymentVerification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payment:verification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Проверка на оплату';

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
        DB::table('booking')->where('id', 3)->update(['phone_user'=> date("H:i:s")]);

    }
}
