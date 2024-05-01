<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class InvoicePaymentRequest extends FormRequest
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

            'Iinn' => 'nullable|string',
            'Acn' => 'nullable|string',
            'Trmn' => 'nullable|string',
            'Trn' => 'nullable|string',
            'Pcn' => 'nullable|string',
            'Pid' => 'nullable|string',
            'Pdt' => 'nullable|string',

        ];
    }
}
