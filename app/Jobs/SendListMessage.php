<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendListMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $list;
    public $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $list, $message)
    {
        $this->list = $list;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (!(trim($this->message) === '')) {

            sms($this->list, $this->message);
        }
    }
}
