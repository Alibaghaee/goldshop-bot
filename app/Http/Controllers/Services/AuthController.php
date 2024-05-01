<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Service\Moadian\AuthServiceController;
use App\Traits\Controller\MixinMethods;
use Illuminate\Http\Request;


use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use SnappMarketPro\Moadian\Constants\PacketType;
use SnappMarketPro\Moadian\Dto\InvoiceBodyDto;
use SnappMarketPro\Moadian\Dto\InvoiceDto;
use SnappMarketPro\Moadian\Dto\InvoiceHeaderDto;
use SnappMarketPro\Moadian\Dto\InvoicePaymentDto;
use SnappMarketPro\Moadian\Dto\Packet;
use SnappMarketPro\Moadian\Moadian;
use Datetime;


class AuthController extends Controller
{
    use MixinMethods;

    /**
     * @var AuthServiceController
     */
    private $authservice;

    public function __construct(AuthServiceController $authservice)
    {

        $this->authservice = $authservice;
    }

    public function action(Request $request)
    {
        $username = 'A29W6F';
        $orgKeyId = Str::uuid();
        $privateKey = file_get_contents(storage_path() . '/app/moadian_secret/rahrayan_private_key.key');
        $signature = file_get_contents(storage_path() . '/app/moadian_secret/rahrayan_csr.csr');
        $publicKey = file_get_contents(storage_path() . '/app/moadian_secret/rahrayan_public_key.txt'); // this is the public key of tax org, not you!


        $data = [
            'user_id' => 1,
//            'username' => '10102661402076',
//            'username' => '6179263310',
            'username' => $username,
            'privateKey' => $privateKey,
//            'publicKey' => $publicKey,
            'orgKeyId' => $orgKeyId,
            'signature' => $signature,
        ];
//        $token = $this->tokenD($data);
//        $res = $this->serverInformationD();
//
//        $res=json_decode($res->getBody()->getContents(), true);
//
//        $publicKeys=$res['result']['data']['publicKeys'][0];
//        dd($publicKeys);
//        return $token;
    }

    public function getPublicKeys(Request $request)
    {
        $username = 'A29W6F';
        $orgKeyId = Str::uuid();
        $privateKey = file_get_contents(storage_path() . '/app/moadian_secret/rahrayan_private_key.key');
        $signature = file_get_contents(storage_path() . '/app/moadian_secret/rahrayan_csr.csr');
        $publicKey = file_get_contents(storage_path() . '/app/moadian_secret/rahrayan_public_key.txt'); // this is the public key of tax org, not you!


        $data = [
            'user_id' => 1,
//            'username' => '10102661402076',
//            'username' => '6179263310',
            'username' => $username,
            'privateKey' => $privateKey,
//            'publicKey' => $publicKey,
            'orgKeyId' => $orgKeyId,
            'signature' => $signature,
        ];
//        $token = $this->tokenD($data);
        $res = $this->serverInformationD();

        $res=json_decode($res->getBody()->getContents(), true);

        $publicKeys=$res['result']['data']['publicKeys'][0];
         return $publicKeys;
    }



}
