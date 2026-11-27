<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'descricao' => ['required', 'string', 'max:255'],
            'margem_lucro' => ['required', 'numeric', 'min:0', 'max:999.99', 'decimal:0,2'],
        ];
    }

    public function messages(): array
    {
        return [
            'descricao.required' => 'A descrição é obrigatória.',
            'margem_lucro.required' => 'A margem de lucro é obrigatória.',
            'margem_lucro.numeric' => 'A margem de lucro deve ser numérica.',
            'margem_lucro.min' => 'A margem de lucro não pode ser negativa.',
            'margem_lucro.max' => 'A margem de lucro deve ser de até 999,99%.',
            'margem_lucro.decimal' => 'A margem de lucro deve ter no máximo duas casas decimais.',
        ];
    }
}
