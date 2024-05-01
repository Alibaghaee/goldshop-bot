<?php

namespace App\Traits\Controller;

use App\Models\AccessAgentToken;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

trait MixinMethods
{

    private function token($data)
    {
        $token = $this->authservice->getToken($data);

        if (is_null($token) || (!policy(AccessAgentToken::class)->expireTime($token))) {

//            $token = $this->authservice->getTokenApi($this->buildScaffoldRequest($data['username'], $data['signature']));
            $token = $this->authservice->getTokenApi($data);


            return $this->authservice->setToken($token)->token;

        } else {


            return $token->token;
        }
    }

    private function tokenD($data)
    {


        $token = $this->authservice->getTokenApiD($this->buildScaffoldRequest($data['username'], $data['signature']));

        return $token;
    }

    private function serverInformationD()
    {


        $token = $this->authservice->getServerInfoApiD($this->buildScaffoldRequestInfo());

        return $token;
    }

    private function buildScaffoldRequestToken(string $username, string $signature): array
    {
        $data = [
            'header' => [
                'Content-Type' => 'application/json',
                'requestTraceId' => (string)Uuid::uuid4(),
                'timestamp' => time() * 1000,///(string)(int)floor(microtime(true) * 1000),
            ],
            'body' => [
                "time" => 1,
                "packet" => [
                    "uid" => null,
                    "packetType" => "GET_TOKEN",
                    "retry" => false,
                    "data" => [
                        "username" => $username
                    ],
                    "encryptionKeyId" => "",
                    "symmetricKey" => "",
                    "iv" => "",
                    "fiscalId" => $username,
                    "dataSignature" => ""
                ],
                "signature" => $signature
            ],
        ];
//        dd($data);
        return $data;
    }

    private function buildScaffoldRequestInfo(): array
    {
        $data = [
            'header' => [
                'Content-Type' => 'application/json',
                'requestTraceId' => (string)Uuid::uuid4(),
                'timestamp' => time() * 1000,///(string)(int)floor(microtime(true) * 1000),
            ],
            'body' => [
                "time" => 1,
                "packet" => [
                    "uid" => null,
                    "packetType" => "GET_SERVER_INFORMATION",
                    "retry" => false,
                    "data" => null,
                    "encryptionKeyId" => "",
                    "symmetricKey" => "",
                    "iv" => "",
                    "fiscalId" => "",
                    "dataSignature" => ""
                ],
            ],
        ];

        return $data;
    }
}
