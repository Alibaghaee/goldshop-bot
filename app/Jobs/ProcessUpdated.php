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

        $message = MessageBot::make();

        $message->update_id = $this->updates->get('update_id');

        if ($this->updates->has('message')) {


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
        } elseif ($this->updates->has('callback_query')) {


            $message->callback_query = true;
            $message->callback_query_text = $this->updates->get('callback_query')['data'];
            $message->message_id = $this->updates->get('callback_query')['message']['message_id'];
            $message->from_id = $this->updates->get('callback_query')['from']['id'];
            $message->from_is_bot = $this->updates->get('callback_query')['from']['is_bot'];
            $message->from_first_name = $this->updates->get('callback_query')['from']['first_name'];
            $message->from_last_name = $this->updates->get('callback_query')['from']['last_name'];
            $message->from_language_code = $this->updates->get('callback_query')['from']['language_code'];


            $message->date = $this->updates->get('callback_query')['message']['date'];

            if (array_key_exists('text', $this->updates->get('callback_query')['message'])) {

                $message->text = $this->updates->get('callback_query')['message']['text'];
            } else {

                $message->text = '';
            }


            if (ChatBot::where('chat_id', $this->updates->get('callback_query')['message']['chat']['id'])->exists()) {
                $message->chat_bot_id = ChatBot::where('chat_id', $this->updates->get('callback_query')['message']['chat']['id'])->first()->id;
            } else {

                $user = User::where('last_chat_id', $this->updates->get('callback_query')['message']['chat']['id'])->first();

                $message->chat_bot_id = ChatBot::create([
                    'chat_id' => $this->updates->get('callback_query')['message']['chat']['id'],
                    'chat_first_name' => $this->updates->get('callback_query')['message']['chat']['first_name'],
                    'chat_last_name' => $this->updates->get('callback_query')['message']['chat']['last_name'],
                    'chat_type' => $this->updates->get('callback_query')['message']['chat']['type'],
                    'user_id' => $user?->id
                ])->id;
            }
        }


        $message->save();

    }
}
