<?php

namespace App\Rahco\Call;

class voiceCallProxy
{
    private $client;

    public function __construct()
    {
        $this->client = new \GuzzleHttp\Client();
    }

    private function post($uri, $form_params)
    {
        $response = $this->client->request('POST', $uri, [
            'form_params' => $form_params,
            'headers'     => [
                'Accept' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody());
    }

    private function post_file($uri, $form_params)
    {
        $response = $this->client->request('POST', $uri, [
            'form_params' => $form_params,
            'headers'     => [
                'Content-Type' => 'multipart/form-data',
                'Accept'       => 'application/json',
            ],
        ]);

        return json_decode($response->getBody());
    }

    private function get($uri)
    {
        $response = $this->client->request('GET', $uri, [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);

        return json_decode($response->getBody());
    }

    private function get_uri($path)
    {
        return 'http://voicemessage.rahco.ir/api/' . trim($path, '/');
    }

    public function send($data)
    {
        return $this->post($this->get_uri('send'), $data);
    }

    public function text_to_call($text, $speaker = 'female')
    {
        return $this->post($this->get_uri('text_to_call'), compact('text', 'speaker'));
    }

    public function voice_to_call($file)
    {
        $response = $this->client->request('POST', $this->get_uri('voice_to_call'), [
            'multipart' => [
                [
                    'name'     => 'voice',
                    'contents' => fopen('/home/admin/domains/5m5.ir/public_html/hamid/voice_file_uploads/' . $file, 'r'),
                ],
            ],
        ]);

        return json_decode($response->getBody());
    }

    public function voice_info($voice_id)
    {
        return $this->get($this->get_uri('get_voice_info/' . $voice_id), compact('text'));
    }

}
