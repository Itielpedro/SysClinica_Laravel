<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procedimento;

class ProcedimentoController extends Controller
{
    public function index()
    {
        try {
            $procedimentos = Procedimento::orderBy('descricao')->get();
            return view('procedimentos.index', compact('procedimentos'));
        } catch (\Exception $e) {
            return redirect()->route('procedimentos.index')->with('error', 'Erro ao listar procedimentos.');
        }
    }

    public function create()
    {
        return view('procedimentos.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'descricao' => 'required',
                'valor' => 'required|numeric',
                'observacoes' => 'nullable',
            ]);

            Procedimento::create($request->all());

            return redirect()->route('procedimentos.index')->with('success', 'Procedimento adicionado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('procedimentos.index')->with('error', 'Erro ao adicionar procedimento.');
        }
    }

    public function edit($id)
    {
        try {
            $procedimento = Procedimento::findOrFail($id);
            return view('procedimentos.edit', compact('procedimento'));
        } catch (\Exception $e) {
            return redirect()->route('procedimentos.index')->with('error', 'Procedimento não encontrado.');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'descricao' => 'required',
                'valor' => 'required|numeric',
                'observacoes' => 'nullable',
            ]);

            $procedimento = Procedimento::findOrFail($id);
            $procedimento->update($request->all());

            return redirect()->route('procedimentos.index')->with('success', 'Procedimento atualizado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('procedimentos.index')->with('error', 'Erro ao atualizar procedimento.');
        }
    }

    public function destroy($id)
    {
        try {
            $procedimento = Procedimento::findOrFail($id);
            $procedimento->delete();

            return redirect()->route('procedimentos.index')->with('success', 'Procedimento excluído com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('procedimentos.index')->with('error', 'Erro ao excluir procedimento.');
        }
    }

    public function search(Request $request)
    {
        try {
            $termo = $request->input('termo');

            $resultadosPesquisa = Procedimento::where('descricao', 'like', "%$termo%")->get();

            return view('procedimentos.index', ['procedimentos' => $resultadosPesquisa, 'termo' => $termo]);
        } catch (\Exception $e) {
            return redirect()->route('procedimentos.index')->with('error', 'Erro ao pesquisar procedimento: ' . $e->getMessage());
        }
    }

}
