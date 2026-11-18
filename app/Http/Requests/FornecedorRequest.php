<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Validação de entrada para criação e atualização de fornecedores.
 */
class FornecedorRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['nullable', 'integer'],
            'nome' => ['required', 'string', 'max:255'],
            'documento' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email:rfc', 'max:255'],
            'endereco' => ['required', 'string', 'max:255'],
            'telefone' => ['required', 'string', 'max:30'],
        ];
    }

    /**
     * Mensagens de validação em português.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nome.required' => 'Nome é obrigatório.',
            'nome.max' => 'Nome deve ter no máximo 255 caracteres.',
            'documento.required' => 'Documento é obrigatório.',
            'documento.max' => 'Documento deve ter no máximo 30 caracteres.',
            'email.required' => 'E-mail é obrigatório.',
            'email.email' => 'E-mail inválido.',
            'email.max' => 'E-mail deve ter no máximo 255 caracteres.',
            'endereco.required' => 'Endereço é obrigatório.',
            'endereco.max' => 'Endereço deve ter no máximo 255 caracteres.',
            'telefone.required' => 'Telefone é obrigatório.',
            'telefone.max' => 'Telefone deve ter no máximo 30 caracteres.',
        ];
    }
}
