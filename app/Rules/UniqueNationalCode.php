<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueNationalCode implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $count = \App\Models\User::where('national_code', $value)->whereHas('purchases', function($query){
            $query->where('payed', 1);
        })->count();

        return $count == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'این کد ملی قبلا ثبت نام شده است.';
    }
}
