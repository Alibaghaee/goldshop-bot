<?php

namespace App\Jobs;

use App\Models\ChatBot;
use App\Models\MessageBot;
use App\Models\User;
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

//        [
//            "update_id" => 674847652,
//            "message" => [
//                "message_id" => 43,
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
//                "date" => 1715008646,
//                "reply_to_message" => [
//                    "message_id" => 42,
//                    "from" => [
//                        "id" => 6949811914,
//                        "is_bot" => true,
//                        "first_name" => "mmd_tala",
//                        "username" => "mmd_tala_bot",
//                    ],
//                    "chat" => [
//                        "id" => 6259458432,
//                        "first_name" => "Nafas",
//                        "last_name" => "Rahco",
//                        "type" => "private",
//                    ],
//                    "date" => 1715008610,
//                    "text" => "با سلام خدمت شما دوست عزیز. از طریق این بات می توانید سفارش خود را به سادگی ثبت کنید. برای بازگشت بین مراحل از دستور /back کنید. اگر آماده هستید با فشردن دکمه اشتراگ گذاری شماره همراه ادامه دهید.",
//                    "entities" => [
//                        [
//                            "offset" => 117,
//                            "length" => 5,
//                            "type" => "bot_command",
//                        ],
//                    ],
//                ],
//                "contact" => [
//                    "phone_number" => "989391431953",
//                    "first_name" => "Nafas",
//                    "last_name" => "Rahco",
//                    "user_id" => 6259458432,
//                ],
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


        $message->date = $this->updates->get('message')['date'];

        if (array_key_exists('contact', $this->updates->get('message')) &&
            array_key_exists('phone_number', $this->updates->get('message')['contact'])) {

            $message->text = 'contact:_' . (string)$this->updates->get('message')['contact']['phone_number'];
        } elseif (array_key_exists('text', $this->updates->get('message'))) {

            $message->text = $this->updates->get('message')['text'];
        } else {

            $message->text = '';
        }


        if (ChatBot::where('chat_id', $this->updates->get('message')['chat']['id'])->exists()) {
            $message->chat_bot_id = ChatBot::where('chat_id', $this->updates->get('message')['chat']['id'])->first()->id;
        } else {

            $message->chat_bot_id = ChatBot::create([
                'chat_id' => $this->updates->get('message')['chat']['id'],
                'chat_first_name' => $this->updates->get('message')['chat']['first_name'],
                'chat_last_name' => $this->updates->get('message')['chat']['last_name'],
                'chat_type' => $this->updates->get('message')['chat']['type'],
            ])->id;
        }

        $message->save();


    }
}
