<?php

namespace App\Jobs;

use App\SenderActionLog;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendSMSMessageUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var User
     */
    private $user;
    /**
     * @var string
     */
    private $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, string $message)
    {

        $this->user = $user;
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


            if (!SenderActionLog::checkActionWithUser($this->user)) {


                $senderActionLog = SenderActionLog::make();
                $senderActionLog->message = $this->message;
                $senderActionLog->user_id = optional($this->user)->id;
                $senderActionLog->save();

                sms(optional($this->user)->mobile, $this->message);
            }
        }
    }
}
