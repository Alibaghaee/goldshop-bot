<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class AddMessagesQueue implements ShouldQueue
{
    protected $sender_operator;
    protected $messages;

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($sender_operator, $messages)
    {
        $this->sender_operator = $sender_operator;
        $this->messages        = $messages;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        DB::connection(config('portal.5m5_db_connection'))
            ->table('md_sms_deliver_' . $this->sender_operator)
            ->insert($this->messages);
    }
}
