<?php

namespace App\Jobs;

use App\SenderActionLog;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSMSMessageMobile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mobile;
    public $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mobile, $message)
    {
        $this->mobile = $mobile;
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


            if (!SenderActionLog::checkActionWithMobile($this->mobile)) {

                $senderActionLog = SenderActionLog::make();
                $senderActionLog->message = $this->message;
                $senderActionLog->mobile = $this->mobile;
                $senderActionLog->save();

                sms($this->mobile, $this->message);
            }
        }
    }
}
