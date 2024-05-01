<?php

namespace App\Console\Commands;

use App\Events\UpgradeSenderNumberEvent;
use Illuminate\Console\Command;

class UpgradeSenderNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upgrade:sender_numbers';

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
        event(new UpgradeSenderNumberEvent());
    }
}
