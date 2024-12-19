<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
            "name" => 'required',
            "cpf" => 'required',
            "email" => 'required',
            "birth_date" => 'required',
            "main_phone" => 'required',
        ];
    }

    public function messages() : array
    {
        return [
            'name.required' => 'O name é de preenchimento obrigatório!',
            'cpf.required' => 'O CPF é de preenchimento obrigatório!',
            'email.required' => 'O e-mail é de preenchimento obrigatório!',
            'city.required' => 'A data de nascimento é de preenchimento obrigatório!',
            'neighborhood.required' => 'O bairro é de preenchimento obrigatório!',
            'main_phone.required' => 'O telefone é de preenchimento obrigatório!',
        ];
    }
}
