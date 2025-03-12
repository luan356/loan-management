<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationContratoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'cliente_id' => 'required|integer',
            'valor' => 'required|numeric',
            'cargo_id' => 'required|in:1,2,3', // Verifica se o cargo_id é 1, 2 ou 3
        ];
    }

    public function messages()
    {
        return [
            'cliente_id.required' => 'O campo cliente_id é obrigatório.',
            'valor.required' => 'O campo valor é obrigatório.',
            'cargo_id.required' => 'O campo cargo_id é obrigatório.',
            'cargo_id.in' => 'O campo cargo_id deve ser 1, 2 ou 3.',
        ];
    }
}
