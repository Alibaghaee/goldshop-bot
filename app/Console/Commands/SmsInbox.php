<?php

namespace App\Console\Commands;

use App\Events\ReceiveStoreEvent;
use Illuminate\Console\Command;

class SmsInbox extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:inbox';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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



            event(new ReceiveStoreEvent());


    }
}
