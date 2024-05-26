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


            $message->message_id = $this->updates->get('message')['message_id'] ?? null;
            $message->from_id = $this->updates->get('message')['from']['id'] ?? null;
            $message->from_is_bot = $this->updates->get('message')['from']['is_bot'] ?? null;
            $message->from_first_name = $this->updates->get('message')['from']['first_name'] ?? null;
            $message->from_last_name = $this->updates->get('message')['from']['last_name'] ?? null;
            $message->from_language_code = $this->updates->get('message')['from']['language_code'] ?? null;


            $message->date = $this->updates->get('message')['date'] ?? null;

            if (array_key_exists('contact', $this->updates->get('message')) &&
                array_key_exists('phone_number', $this->updates->get('message')['contact'])) {

                $message->text = 'contact:_' . (string)$this->updates->get('message')['contact']['phone_number'] ?? null;
            } elseif (array_key_exists('text', $this->updates->get('message'))) {

                $message->text = $this->updates->get('message')['text'] ?? null;
            } else {

                $message->text = '';
            }


            if (ChatBot::where('chat_id', $this->updates->get('message')['chat']['id'])->exists()) {
                $message->chat_bot_id = ChatBot::where('chat_id', $this->updates->get('message')['chat']['id'])->first()->id;
            } else {

                $message->chat_bot_id = ChatBot::create([
                    'chat_id' => $this->updates->get('message')['chat']['id'] ?? null,
                    'chat_first_name' => $this->updates->get('message')['chat']['first_name'] ?? null,
                    'chat_last_name' => $this->updates->get('message')['chat']['last_name'] ?? null,
                    'chat_type' => $this->updates->get('message')['chat']['type'] ?? null,
                ])->id;
            }
        } elseif ($this->updates->has('callback_query')) {


            $message->callback_query = true;
            $message->callback_query_text = $this->updates->get('callback_query')['data'] ?? null;
            $message->message_id = $this->updates->get('callback_query')['message']['message_id'] ?? null;
            $message->from_id = $this->updates->get('callback_query')['from']['id'] ?? null;
            $message->from_is_bot = $this->updates->get('callback_query')['from']['is_bot'] ?? null;
            $message->from_first_name = $this->updates->get('callback_query')['from']['first_name'] ?? null;
            $message->from_last_name = $this->updates->get('callback_query')['from']['last_name'] ?? null;
            $message->from_language_code = $this->updates->get('callback_query')['from']['language_code'] ?? null;


            $message->date = $this->updates->get('callback_query')['message']['date'] ?? null;

            if (array_key_exists('text', $this->updates->get('callback_query')['message'])) {

                $message->text = $this->updates->get('callback_query')['message']['text'] ?? null;
            } else {

                $message->text = '';
            }


            if (ChatBot::where('chat_id', $this->updates->get('callback_query')['message']['chat']['id'])->exists()) {
                $message->chat_bot_id = ChatBot::where('chat_id', $this->updates->get('callback_query')['message']['chat']['id'])->first()->id;
            } else {

                $user = User::where('last_chat_id', $this->updates->get('callback_query')['message']['chat']['id'])->first();

                $message->chat_bot_id = ChatBot::create([
                    'chat_id' => $this->updates->get('callback_query')['message']['chat']['id'] ?? null,
                    'chat_first_name' => $this->updates->get('callback_query')['message']['chat']['first_name'] ?? null,
                    'chat_last_name' => $this->updates->get('callback_query')['message']['chat']['last_name'] ?? null,
                    'chat_type' => $this->updates->get('callback_query')['message']['chat']['type'] ?? null,
                    'user_id' => $user?->id
                ])->id;
            }
        }

        if ($this->updates->has('message') || $this->updates->has('callback_query')) {

            $message->save();
        }

    }
}
