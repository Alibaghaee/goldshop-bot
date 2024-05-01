<?php

namespace App\Service\Moadian;


use App\Models\AccessAgentToken;
use App\Traits\Service\HasBaseMethods;
use GuzzleHttp\Client;
use SnappMarketPro\Moadian\Moadian;

class AuthServiceController
{
    use HasBaseMethods;


    public function __construct()
    {
        $this->endPoint = env('MOADIAN_ENDPOINT');


    }

    public function getTokenApi($data)
    {
//        return $this->prepare('post', $this->endPoint, env('MOADIAN_ENDPOINT_TAG') . '/sync/GET_TOKEN', $data['body'], null, $data['header']);

        $moadian = new Moadian(
            $data['publicKey'],
            $data['privateKey'],
            $data['orgKeyId'],
            $data['username']
        );

        $token = $moadian->getToken();
        $data['token'] = $token->getToken();
        $data['expires_in'] = $token->getExpiresAt();

        return $data;
    }

    public function getTokenApiD($data)
    {
        return $this->prepare('post', $this->endPoint, env('MOADIAN_ENDPOINT_TAG') . '/sync/GET_TOKEN', $data['body'], null, $data['header']);
    }

    public function getServerInfoApiD($data)
    {
        $client = new Client([
            'base_uri' => 'https://tp.tax.gov.ir',
            'headers' => ['Content-Type' => 'application/json'],
        ]);

        return   $client->post('req/api/self-tsp/sync/GET_SERVER_INFORMATION', [
            'body' => json_encode($data['body']),
            'headers' => $data['header'],
        ]);
    }

    public function setToken($data): AccessAgentToken
    {
        ///store token
        return AccessAgentToken::setToken($data);
    }

    public function getToken($data)
    {
        ///get stored token
        return AccessAgentToken::getToken($data);
    }

}
