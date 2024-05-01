<?php

namespace App\Console\Commands;

use App\Models\General\Blacklist;
use Illuminate\Console\Command;

class CheckBlacklistCash extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blacklist:check-cash';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check the blacklists. If users have enough cash, put them in the queue again';

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
        $queue = Blacklist::lackOfCash()->get();

        foreach ($queue as $blacklist) {
            $blacklist->checkForEnoughOfCash();
        }

        $queue = Blacklist::Queue()->get();

        foreach ($queue as $blacklist) {
            $blacklist->checkForLackOfCash();
        }
    }
}
