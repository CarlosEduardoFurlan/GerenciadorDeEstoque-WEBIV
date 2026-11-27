<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;
use App\Services\AtualizarMargemCategoria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class CategoriaController extends Controller
{
    public function index(): View
    {
        return view('categorias.index', [
            'categorias' => Categoria::query()->orderBy('descricao')->orderBy('id')->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('categorias.form', ['categoria' => new Categoria]);
    }

    public function store(CategoriaRequest $request): RedirectResponse
    {
        Categoria::create($request->validated());

        return to_route('categorias.index')->with('success', 'Categoria cadastrada com sucesso.');
    }

    public function edit(Categoria $categoria): View
    {
        return view('categorias.form', compact('categoria'));
    }

    public function update(CategoriaRequest $request, Categoria $categoria, AtualizarMargemCategoria $service): RedirectResponse
    {
        $service->atualizar($categoria, $request->validated());

        return to_route('categorias.index')->with('success', 'Categoria atualizada com sucesso.');
    }

    public function destroy(Categoria $categoria): RedirectResponse
    {
        $excluida = DB::transaction(function () use ($categoria): bool {
            if (Schema::hasTable('produto') && DB::table('produto')->where('categoria_id', $categoria->id)->exists()) {
                return false;
            }

            $categoria->delete();

            return true;
        });

        return $excluida
            ? to_route('categorias.index')->with('success', 'Categoria excluída com sucesso.')
            : to_route('categorias.index')->with('error', 'Esta categoria possui produtos e não pode ser excluída.');
    }
}
