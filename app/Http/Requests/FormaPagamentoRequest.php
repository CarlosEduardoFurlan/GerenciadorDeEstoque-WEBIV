<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class FormaPagamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'descricao' => ['required', 'string', 'max:255'],
            'numero_parcelas' => ['required', 'integer', 'min:1'],
            'itens' => ['required', 'array', 'min:1'],
            'itens.*.porcentagem' => ['required', 'numeric', 'min:0', 'max:100', 'decimal:0,2'],
            'itens.*.dia' => ['required', 'integer', 'min:0'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            $itens = $this->input('itens', []);

            if (count($itens) !== (int) $this->input('numero_parcelas')) {
                $validator->errors()->add(
                    'itens',
                    'A quantidade de itens deve ser igual ao número de parcelas.'
                );
            }

            $totalEmCentavos = collect($itens)->sum(
                fn (array $item): int => (int) round(((float) $item['porcentagem']) * 100)
            );

            if ($totalEmCentavos !== 10000) {
                $validator->errors()->add(
                    'itens',
                    'A soma das porcentagens deve ser exatamente 100%.'
                );
            }
        });
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'descricao.required' => 'Descrição é obrigatória.',
            'descricao.max' => 'Descrição deve ter no máximo 255 caracteres.',
            'numero_parcelas.required' => 'Número de parcelas é obrigatório.',
            'numero_parcelas.integer' => 'Número de parcelas deve ser inteiro.',
            'numero_parcelas.min' => 'Número de parcelas deve ser pelo menos 1.',
            'itens.required' => 'Informe os itens da forma de pagamento.',
            'itens.array' => 'Os itens informados são inválidos.',
            'itens.min' => 'Informe pelo menos um item.',
            'itens.*.porcentagem.required' => 'Porcentagem é obrigatória em todos os itens.',
            'itens.*.porcentagem.numeric' => 'Porcentagem deve ser numérica.',
            'itens.*.porcentagem.min' => 'Porcentagem não pode ser negativa.',
            'itens.*.porcentagem.max' => 'Porcentagem não pode ser maior que 100%.',
            'itens.*.porcentagem.decimal' => 'Porcentagem deve ter no máximo duas casas decimais.',
            'itens.*.dia.required' => 'Dia é obrigatório em todos os itens.',
            'itens.*.dia.integer' => 'Dia deve ser um número inteiro.',
            'itens.*.dia.min' => 'Dia não pode ser negativo.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'descricao' => 'descrição',
            'numero_parcelas' => 'número de parcelas',
            'itens.*.porcentagem' => 'porcentagem',
            'itens.*.dia' => 'dia',
        ];
    }
}
