<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceBodyRequest extends FormRequest
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

            'Sstid' => 'nullable|string',
            'Sstt' => 'nullable|string',
            'Mu' => 'nullable|string',
            'Am' => 'nullable|string',
            'Fee' => 'nullable|string',
            'Cfee' => 'nullable|string',
            'Cut' => 'nullable|string',
            'Exr' => 'nullable|string',
            'Prdis' => 'nullable|string',
            'Dis' => 'nullable|string',
            'Adis' => 'nullable|string',
            'Vra' => 'nullable|string',
            'Vam' => 'nullable|string',
            'Odt' => 'nullable|string',
            'Odr' => 'nullable|string',
            'Odam' => 'nullable|string',
            'Olt' => 'nullable|string',
            'Olr' => 'nullable|string',
            'Olam' => 'nullable|string',
            'Consfee' => 'nullable|string',
            'Spro' => 'nullable|string',
            'Bros' => 'nullable|string',
            'Tcpbs' => 'nullable|string',
            'Cop' => 'nullable|string',
            'Bsrn' => 'nullable|string',
            'Vop' => 'nullable|string',
            'Tsstam' => 'nullable|string',
        ];
    }
}
