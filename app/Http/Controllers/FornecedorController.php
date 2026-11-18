<?php

namespace App\Http\Controllers;

use App\Http\Requests\FornecedorRequest;
use App\Models\Fornecedor;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Controlador responsável pelo CRUD e listagem paginada de fornecedores.
 */
class FornecedorController extends Controller
{
    /**
     * Lista os fornecedores ordenados alfabeticamente por nome com paginação de 10 registros.
     */
    public function listar(): View
    {
        $fornecedores = Fornecedor::orderBy('nome')->paginate(10);

        return view('listagem_fornecedor', compact('fornecedores'));
    }

    /**
     * Exibe o formulário para cadastro de um novo fornecedor.
     */
    public function novo(): View
    {
        $fornecedor = new Fornecedor;
        $fornecedor->id = 0;
        $fornecedor->nome = '';
        $fornecedor->documento = '';
        $fornecedor->email = '';
        $fornecedor->endereco = '';
        $fornecedor->telefone = '';

        return view('formulario_fornecedor', compact('fornecedor'));
    }

    /**
     * Persiste um novo fornecedor (id == 0) ou atualiza um existente (id > 0).
     */
    public function salvar(FornecedorRequest $request): RedirectResponse
    {
        $dados = $request->safe()->except('id');
        $id = (int) $request->input('id', 0);

        $fornecedor = $id === 0
            ? new Fornecedor
            : Fornecedor::findOrFail($id);

        $fornecedor->fill($dados);
        $fornecedor->save();

        return redirect('fornecedor/listar');
    }

    /**
     * Carrega os dados de um fornecedor existente para edição.
     */
    public function editar(int|string $id): View
    {
        $fornecedor = Fornecedor::findOrFail($id);

        return view('formulario_fornecedor', compact('fornecedor'));
    }

    /**
     * Exclui um fornecedor existente a partir do seu identificador.
     */
    public function excluir(int|string $id): RedirectResponse
    {
        $fornecedor = Fornecedor::findOrFail($id);
        $fornecedor->delete();

        return redirect('fornecedor/listar');
    }
}
