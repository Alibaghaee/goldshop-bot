<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExportLotteryOneJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 1800;

    protected $lottery_one;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($lottery_one)
    {
        $this->lottery_one = $lottery_one;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->lottery_one->exportCsv();
    }
}
