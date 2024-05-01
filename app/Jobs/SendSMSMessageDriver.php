<?php

namespace App\Jobs;

use App\Models\General\Driver;
use App\SenderActionLog;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSMSMessageDriver implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Driver
     */
    private $driver;
    /**
     * @var string
     */
    private $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Driver $driver, string $message)
    {

        $this->driver = $driver;
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


            if (!SenderActionLog::checkActionWithMobile($this->driver->mobile)) {

                $senderActionLog = SenderActionLog::make();
                $senderActionLog->message = $this->message;
                $senderActionLog->mobile = optional($this->driver)->mobile;
                $senderActionLog->save();

                sms($this->driver->mobile, $this->message);
            }
        }
    }
}
