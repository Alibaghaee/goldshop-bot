<?php

namespace App\Rahco\Call;

use App\Models\Api\AvanakVoice;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Avanak
{

    private function call($function, $params)
    {

        $wsdl   = 'https://portal.avanak.ir/webservice3.asmx?wsdl';
        $params = $this->getFullParams($params);

        try
        {
            $client = new \SoapClient($wsdl);
            try
            {
                return $client->$function($params);
            } catch (Exception $e) {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function sendBatchCallRequest($mobiles, $voice_id, $retry_count = 1)
    {

        $response = $this->call('CreateCampaign', [
            'title'              => (string) time(),
            'numbers'            => implode(',', $mobiles),
            'maxTryCount'        => $retry_count,
            'minuteBetweenTries' => '10',
            'startDate'          => now()->format('Y-m-d'),
            'startTime'          => '08:00',
            'endDate'            => now()->format('Y-m-d'),
            'endTime'            => '22:00',
            'messageId'          => $voice_id,
            'removeInvalids'     => 'true',
            'serverId'           => '35', // 1,15,20,25,30,35,40
            'autoStart'          => 'true',
            'vote'               => 'true',
        ]);

        return $response->CreateCampaignResult;
    }

    public function callStatus($campaign_id = '')
    {
        $response = $this->call('GetCampaignById', [
            'campaignId' => $campaign_id,
        ]);
        return json_decode(json_encode($response->GetCampaignByIdResult), true);
    }

    /**
     * Convert a text to voice and get the voice_id
     * @param  String $text
     * @param  String $speaker
     * @return String
     */
    public function textToSpeech($text, $speaker = 'female')
    {
        return $this->sendTextToSpeechRequest($text, $speaker);
    }

    private function sendTextToSpeechRequest(String $text, String $speaker)
    {
        $response = $this->call('GenerateTTS', [
            'speaker'        => $speaker,
            'text'           => $text,
            'title'          => (string) time(),
            'CallFromMobile' => env('AVANAK_USERNAME'),
        ]);
        return $response->GenerateTTSResult;
    }

    /**
     * To use a custom voice in a call, the client has to first upload the
     * file and retrieve the identifier. this identifier can then
     * be used in call APIs.
     * The file should be in binary format and the limit must be less than 128 megabytes.
     * The uploaded file can later be downloaded using the voiceId.
     * @param  String $path voice sound path
     * @return Array
     */
    public function uploadVoice($path)
    {
        $params = [
            'file'           => file_get_contents($path),
            'title'          => (string) time(),
            'Persist'        => 'true',
            'CallFromMobile' => '',
        ];
        $result = $this->call('UploadMessage', $params);
        return $result ? $result->UploadMessageResult : false;
    }

    public function downloadVoice(String $voice_id)
    {
        $result = $this->call('DownloadMessage', ['messageId' => $voice_id]);
        header('Content-Type: audio/x-wav, audio/wav');
        header('Content-Disposition: attachment; filename="' . $voice_id . '.wav"');
        echo $result->DownloadMessageResult;
    }

    /**
     * store voice in local storage if the same voice not stored before
     * @param  String $voice_id
     * @return Mix file path or Null value
     */
    public function storeRemoteVoice(String $voice_id)
    {

        // check voice existance
        $voice = AvanakVoice::where('voice_id', $voice_id)->first();
        if ($voice) {
            return $voice->file;
        }

        // store file in local storag
        $filename = $voice_id . '.wav';
        $result   = $this->call('DownloadMessage', ['messageId' => $voice_id]);
        $result   = Storage::disk('voice')->put($voice_id . '.wav', $result->DownloadMessageResult);
        if (!$result) {
            return null;
        }
        return $filename;
    }

    /**
     * convert text to voice, store voice locally and insert new voice record
     * @param  String $text
     * @param  string $speaker
     * @return Json
     */
    public function handelTextRequest($text, $speaker = 'female')
    {
        $voice_id         = $this->textToSpeech($text, $speaker);
        $voice_local_path = $this->storeRemoteVoice($voice_id);
        $voice_duration   = audio_duration(public_path('storage/voices/' . $voice_local_path));
        // create model
        $avanak_voice               = AvanakVoice::firstOrNew(['voice_id' => $voice_id]);
        $avanak_voice->file         = $voice_local_path;
        $avanak_voice->voice_id     = $voice_id;
        $avanak_voice->duration     = $voice_duration;
        $avanak_voice->message      = $text;
        $avanak_voice->date_created = now()->toDateTimeString();
        $avanak_voice->save();
        return $avanak_voice->only(['file', 'voice_id', 'duration']);
    }

    /**

     * store user uploaded file

     * @return [type] [description]

     */

    public function storeUploadedFile(Request $request)
    {

        $md5_name = md5($request->file('voice')->getRealPath() . time()) . '.wav';

        $voice_local_path = $request->file('voice')->storeAs('voices', $md5_name, 'public');

        $path = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $voice_local_path);

        return [
            'path'     => $path,
            'md5_name' => $md5_name,
        ];

    }

    public function calcPrice($voice_id)
    {
        // return 10;
    }

    private function getFullParams($params)
    {

        $auth_param = [
            'userName' => env('AVANAK_USERNAME'),
            'password' => env('AVANAK_PASSWORD'),
        ];

        $full_params = array_merge($auth_param, $params);

        return $full_params;
    }

}
