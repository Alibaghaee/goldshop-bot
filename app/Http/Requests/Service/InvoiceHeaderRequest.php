<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceHeaderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invoice_id' => 'required|exists:\App\Models\Invoice,id',

            'Indati2m' => 'nullable|string',
            'Indatim' => 'nullable|string',
            'Inty' => 'nullable|string',
            'Ft' => 'nullable|string',
            'Inno' => 'nullable|string',
            'Irtaxid' => 'nullable|string',
            'Scln' => 'nullable|string',
            'Setm' => 'nullable|string',
            'Tins' => 'nullable|string',
            'Cap' => 'nullable|string',
            'Bid' => 'nullable|string',
            'Insp' => 'nullable|string',
            'Tvop' => 'nullable|string',
            'Bpc' => 'nullable|string',
            'Tax17' => 'nullable|string',
            'Inp' => 'nullable|string',
            'Scc' => 'nullable|string',
            'Ins' => 'nullable|string',
            'Billid' => 'nullable|string',
            'Tprdis' => 'nullable|string',
            'Tdis' => 'nullable|string',
            'Tadis' => 'nullable|string',
            'Tvam' => 'nullable|string',
            'Todam' => 'nullable|string',
            'Tbill' => 'nullable|string',
            'Tob' => 'nullable|string',
            'Tinb' => 'nullable|string',
            'Sbc' => 'nullable|string',
            'Bbc' => 'nullable|string',
            'Bpn' => 'nullable|string',
            'Crn' => 'nullable|string',
            'dpvb' => 'nullable|string',
        ];
    }
}
