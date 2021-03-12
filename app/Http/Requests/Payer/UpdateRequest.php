<?php

namespace App\Http\Requests\Payer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'nullable|string',
            'document' => ['nullable','string', 'unique:payers', new \App\Rules\Document],
            'phone' => ['nullable','string', new \App\Rules\Phone],
            'email' => 'nullable|string',
            'birth' => 'nullable|date_format:Y-m-d',
            'address_cep' => ['nullable','string', new \App\Rules\CEP],
            'address_street' => 'nullable|string',
            'address_district' => 'nullable|string',
            'address_number' => 'nullable|numeric',
            'address_complement' => 'nullable|string',
            'address_city' => 'nullable|string',
            'address_state' => 'nullable|string',
        ];
    }
}
