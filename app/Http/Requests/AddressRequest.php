<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Contracts\Service\Attribute\Required;

class AddressRequest extends FormRequest
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
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'erros' => $validator->errors(),
        ], 422));
    }

    public function rules(): array
    {
        return [
            'postal_code' => 'required',
            'street' => 'required',
            'number' => 'nullable|numeric',
            'additional_information' => 'nullable',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
        ];
    }

    public function messages() : array
    {
        return [
            'postal_code.required' => 'O cep é de preenchimento obrigatório!',
            'street.required' => 'A rua é de preenchimento obrigatório!',
            'neighborhood.required' => 'O bairro é de preenchimento obrigatório!',
            'city.required' => 'A cidade é de preenchimento obrigatório!',
            'state.required' => 'O estado é de preenchimento obrigatório!',
            'country.required' => 'O país é de preenchimento obrigatório!',
        ];
    }
}
