<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class TitleType implements Rule
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
        return $value == 1 OR $value == 2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'As opções disponíveis são [1] para valor fixo e [2] para porcentagem.';
    }
}
