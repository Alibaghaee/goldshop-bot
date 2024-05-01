<?php

namespace App\Http\Controllers\Services;

use App\Exceptions\MoadianServiceInjectException;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoicePacket;
use App\Service\Moadian\InvoiceServiceController;
use App\Service\Moadian\SendServiceController;
use SnappMarketPro\Moadian\Moadian;


class SendController extends Controller
{
    /**
     * @var InvoiceServiceController
     */
    private $invoiceServiceController;
    /**
     * @var SendServiceController
     */
    private $sendServiceController;

    public function __construct(
        InvoiceServiceController $invoiceServiceController,
        SendServiceController    $sendServiceController
    )
    {
        $this->invoiceServiceController = $invoiceServiceController;
        $this->sendServiceController = $sendServiceController;
    }

    /**
     * Send resource.
     *
     * @param InvoicePacket $invoicePacket
     */
    public function send(Invoice $invoice)
    {
        if (
            $invoice->invoiceHeader()->exists() &&
            $invoice->invoiceBody()->exists() &&
            $invoice->invoicePayment()->exists() &&
            $invoice->invoicePacket()->exists()
        ) {
            $invoiceHeaderDto = $this->invoiceServiceController->setHeader($invoice->invoiceHeader);
            $invoiceBodyDto = $this->invoiceServiceController->setBody($invoice->invoiceBody);
            $invoicePaymentDto = $this->invoiceServiceController->setPayment($invoice->invoicePayment);
            $invoiceDto = $this->invoiceServiceController->setInvoice($invoiceHeaderDto, $invoiceBodyDto, $invoicePaymentDto);
            $packet = $this->invoiceServiceController->setPacket($invoiceHeaderDto, $invoice->invoicePacket);


            $response = $this->sendServiceController->send($packet);
            dd($response);

        }


        return redirect()->back()->with('success', 'با موفقیت ارسال شد' . '\\n' . '');
    }

    public function testRef()
    {
//        $ref='d4c637c3-809a-4408-b012-a7b22d561397';
//        $ref = 'dc70266f-1ef5-46c0-8c28-c509526c49fb'; /////"{"signature":null,"signatureKeyId":null,"timestamp":1690113155,"result":[{"uid":"d4b20832-5f30-4d44-b58a-65fc72aab9c9","referenceNumber":"dc70266f-1ef5-46c0-8c28-c509526c49fb","errorCode":null,"errorDetail":null}]}

//        $ref = "18077b55-4897-4f40-9a57-8ed363816d75";          ////"{"signature":null,"signatureKeyId":null,"timestamp":1690186091,"result":[{"uid":"28a696fd-d81d-467d-8937-ffc7667e2513","referenceNumber":"18077b55-4897-4f40-9a57-8ed363816d75","errorCode":null,"errorDetail":null}]}

//        $ref="e0364d3a-c564-4bef-ab46-571424bfd673";
//        $ref="be4d7656-3431-48dd-93e3-63cd2a82a6f5";
//        $ref="e644b42b-b376-48f1-ad01-e229b2b82aec";
//        $ref="a3a48a96-152d-45cb-b1d6-5f862d9e2ea7";
//        $ref="7ea18d15-6258-4b87-b24c-897dbcccabb0";//invoice20
//        $ref="ad99e90b-df3f-42ea-b6ff-2439c388a637";//invoice23
//        $ref = "875652d6-73b8-4afc-b8d6-8f05ff1dc5a3";
//        $ref = "daa87cc5-2fe0-49dc-8297-cda48f3fd38a";
//        $ref = "b1d3c0af-f11d-4d2d-9da8-ec6810f07da3";
//        $ref = "c79ca510-d053-4c82-b1e4-a682ac5a6183";
//        $ref = "28a4d3df-0364-43b4-ad27-18dfee634593";
//        $ref = "433f4d61-65bc-4b05-bb58-e8ce0d133d7d";
//        $ref = "53209404-57a4-477f-99a1-9b00b5a204e8";
//        $ref = "0c58d8f9-e04d-4cdb-8433-ea8a473b0f4f";
//        $ref = "afb7de57-291b-4ea9-abeb-796e9477862e";
        $ref = "721ac654-20f4-4e4e-988f-7171cc3d7d8b";

        $res = $this->invoiceServiceController->inquiryByReferenceNumberD($ref);

        dd($res);
    }

}
