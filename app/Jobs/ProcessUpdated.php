<?php

namespace App\Jobs;

use App\Models\MessageBot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class ProcessUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $updates;

    /**
     * Create a new job instance.
     */
    public function __construct($updates)
    {
        $this->updates = $updates;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
//        $data = [
//            "update_id" => 674847639,
//            "message" => [
//                "message_id" => 25,
//                "from" => [
//                    "id" => 6259458432,
//                    "is_bot" => false,
//                    "first_name" => "Nafas",
//                    "last_name" => "Rahco",
//                    "language_code" => "en",
//                ],
//                "chat" => [
//                    "id" => 6259458432,
//                    "first_name" => "Nafas",
//                    "last_name" => "Rahco",
//                    "type" => "private",
//                ],
//                "date" => 1714637429,
//                "text" => "hi ali",
//            ],
//        ];

        $message = MessageBot::make();

        $message->update_id = $this->updates->get('update_id');
        $message->message_id = $this->updates->get('message')['message_id'];
        $message->from_id = $this->updates->get('message')['from']['id'];
        $message->from_is_bot = $this->updates->get('message')['from']['is_bot'];
        $message->from_first_name = $this->updates->get('message')['from']['first_name'];
        $message->from_last_name = $this->updates->get('message')['from']['last_name'];
        $message->from_language_code = $this->updates->get('message')['from']['language_code'];

        $message->chat_id = $this->updates->get('message')['chat']['id'];
        $message->chat_first_name = $this->updates->get('message')['chat']['first_name'];
        $message->chat_last_name = $this->updates->get('message')['chat']['last_name'];
        $message->chat_type = $this->updates->get('message')['chat']['type'];
        $message->date = $this->updates->get('message')['date'];
        $message->text = $this->updates->get('message')['text'];

        $message->save();
    }
}
