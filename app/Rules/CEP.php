<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CEP implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if(strlen($value) != 10) return false;
        $value = $this->clear($value);
        return strlen($value) == 8;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O CEP deve conter o formato [00 000-000].';
    }

    private function clear($string)
    {
        return trim(str_replace(' ','', str_replace('-','',$string)));
    }
}
