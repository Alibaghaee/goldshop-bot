<?php

namespace App\Service\Moadian;


use App\Traits\Service\HasBaseMethods;

use SnappMarketPro\Moadian\Dto\Packet;

class SendServiceController
{



    private $moadian;

    public function __construct($moadian)
    {
        $this->endPoint = env('MOADIAN_ENDPOINT');


        $this->moadian = $moadian;
    }


    public function send(Packet $packet)
    {
        $token = $this->moadian->getToken();

        $invoice = $this->moadian
            ->setToken($token)
            ->sendInvoice($packet);

        return $invoice->getBody()->getContents();
    }

}
