<?php

namespace App\Rules;

use App\Helpers\DiscountCode;
use Illuminate\Contracts\Validation\Rule;

class DiscountCodeRule implements Rule
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
        return (new DiscountCode)->check($value) == false ? false : true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'کد تخفیف معتبر نیست.';
    }
}
