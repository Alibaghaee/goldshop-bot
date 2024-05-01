<?php

namespace App\Http\Resources\Payment;

use App\Http\Resources\Payment\SimplePayment;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SimplePaymentCollection extends ResourceCollection
{
    /**
     * The resource that this resource collects.
     *
     * @var string
     */

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
