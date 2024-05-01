<?php

namespace App\Traits\Service;

use Illuminate\Support\Facades\Http;

trait HasBaseMethods
{


//    public function headers()
//    {
//        return [
//            'Authorization' => request()->headers->get('Authorization')
//        ];
//    }

    public function request($header)
    {
        return Http::withHeaders($header);
    }

    /**
     *Prepare request structure.
     *
     * @param $type
     * @param string $endpoint
     * @param string $exEndPonit
     * @param  $data
     * @param  $id
     **/
    public function prepare($type, string $endpoint, string $exEndPonit, $data = null, $id = null, $header = [])
    {

        return
            $this->request($header)
                ->{$type}($endpoint . '/' . $exEndPonit . '/' . $id, $data);
    }


}
