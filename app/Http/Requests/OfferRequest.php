<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_ar'=> 'required|max:100',
            'name_en'=> 'required|max:100',
            'price'=> 'required|numeric',
            'details_ar'=> 'required',
            'details_en'=> 'required',

        ];
    }

    public function messages(): array
    {
        return $error_msg=[
        'name.required'=> __( 'messages.offer name required'),
        'price.numeric' => __( 'messages.offer name must be unique'),
    ];
    }
}
