<?php

namespace App\Http\Requests;

use App\Rules\MobileNumbers;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'name'=>'required|string|max:255',
            'family'=>'required|string|max:255',

            'second_mobile'=>['nullable','string','max:255',new MobileNumbers()],
            'address'=>'nullable|string|max:50000',
        ];
    }
}
