<?php

namespace App\Bot\Factory;


class FactoryBot
{
    public static function createBot($type): BotInterface
    {
        switch ($type) {
            case 'user':
                return new UserBot();
            case 'manager':
                return new ManagerBot();
            case 'price_manager':
                return new PriceManagerBot();
            default:
                throw new \Exception("Unknown bot type");
        }
    }
}
