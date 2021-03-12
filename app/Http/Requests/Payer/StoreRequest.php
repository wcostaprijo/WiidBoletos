<?php

namespace App\Http\Requests\Payer;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => 'required|string',
            'document' => ['required','string', 'unique:payers', new \App\Rules\Document],
            'phone' => ['required','string', new \App\Rules\Phone],
            'email' => 'required|string',
            'birth' => 'required|date_format:Y-m-d',
            'address_cep' => ['required','string', new \App\Rules\CEP],
            'address_street' => 'required|string',
            'address_district' => 'required|string',
            'address_number' => 'nullable|numeric',
            'address_complement' => 'nullable|string',
            'address_city' => 'required|string',
            'address_state' => 'required|string',
        ];
    }
}
