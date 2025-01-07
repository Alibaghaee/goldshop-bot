<?php

namespace App\Service\TellBot;

use App\Bot\Factory\FactoryBot;


class TelegramServiceController
{
    protected $bot;
    protected string $botRole;


    public function __construct(string $botRole)
    {
        $this->bot = FactoryBot::createBot($botRole);
        $this->botRole = $botRole;
    }

    public function send($data)
    {

        $this->bot->send($data);
    }

    public function sendDocument($data)
    {
        $this->bot->sendDocument($data);
    }

    public function deleteMessage($chatId, $messageId)
    {


// Define your bot token and the message_id of the bot message to be deleted
        $botToken = '';
        if ($this->botRole === 'user') {

            $botToken = env('TELEGRAM_BOT_TOKEN_USER');
        } elseif ($this->botRole === 'manager') {

            $botToken = env('TELEGRAM_BOT_TOKEN_MANAGER');
        } elseif ($this->botRole === 'price_manager') {

            $botToken = env('TELEGRAM_BOT_TOKEN_PRICE_MANAGER');
        }elseif ($this->botRole === 'price_abshode_manager') {

            $botToken = env('TELEGRAM_BOT_TOKEN_PRICE_ABSHODE');
        }elseif ($this->botRole === 'price_coin_manager') {

            $botToken = env('TELEGRAM_BOT_TOKEN_PRICE_COIN');
        }


// Set the API endpoint URL for deleting a message
        $apiEndpoint = "https://api.telegram.org/bot{$botToken}/deleteMessage";

// Prepare the POST request data
        $data = [
            'chat_id' => $chatId, // Specify the chat ID where the message is located
            'message_id' => $messageId
        ];

// Initialize cURL session
        $ch = curl_init();

// Set cURL options
        curl_setopt($ch, CURLOPT_URL, $apiEndpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request
        $response = curl_exec($ch);

// Close cURL session
        curl_close($ch);

// Check the response from the API
//        if ($response === false) {
//            return false;
//        } else {
//            $responseData = json_decode($response, true);
//            if ($responseData['ok']) {
//                return true;
//            } else {
//                return false;
//            }
//        }

    }
}
