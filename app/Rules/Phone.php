<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Phone implements Rule
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
        if(strlen($value) != 14 AND strlen($value) != 15) return false;
        $value = $this->clear($value);
        return strlen($value) == 10 OR strlen($value) == 11;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O número de telefone deve ser residencial [(00) 0000-0000] ou um telefone movél [(00) 00000-0000].';
    }

    private function clear($string)
    {
        return trim(str_replace(' ','', str_replace('(','',str_replace(')','',str_replace('-','',$string)))));
    }
}
