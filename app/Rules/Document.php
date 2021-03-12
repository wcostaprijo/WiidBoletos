<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Document implements Rule
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
        if(strlen($value) != 14 AND strlen($value) != 18) return false;
        $value = $this->clear($value);
        return strlen($value) == 11 OR strlen($value) == 14;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O documento informado deve ser um CPF [000.000.000-00] ou um CNPJ [00.000.000/0000-00].';
    }

    private function clear($string)
    {
        return trim(str_replace('-','', str_replace('.','',str_replace(',','',str_replace(' ','',str_replace('/','',$string))))));
    }
}
