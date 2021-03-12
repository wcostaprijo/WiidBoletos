<?php

namespace App\Http\Requests\Title;

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
            'payer_id' => 'required|exists:payers,id',
            'due_date' => 'required|date_format:Y-m-d|after_or_equal:'.now()->format('Y-m-d'),
            'value' => 'required|integer',
            'description' => 'required',
            'fine_type' => ['nullable','integer', new \App\Rules\TitleType],
            'fine_value' => 'required_with:fine_type',
            'fee_type' => ['nullable','integer', new \App\Rules\TitleType],
            'fee_value' => 'required_with:fee_type|integer',
            'discount_type' => ['nullable','integer', new \App\Rules\TitleType],
            'discount_value' => 'required_with:discount_type|integer',
            'discount_date_limit' => 'required_with:discount_type|date_format:Y-m-d|after_or_equal:'.now()->format('Y-m-d'),
            'reference' => 'nullable',
            'instruction_one' => 'nullable',
            'instruction_two' => 'nullable',
            'instruction_three' => 'nullable',
        ];
    }
}
