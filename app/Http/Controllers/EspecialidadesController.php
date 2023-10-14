<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Especialidade;
use Illuminate\Http\Request;

class EspecialidadesController extends Controller
{
    public function index()
    {
        $especialidades = Especialidade::orderBy('nome')->get();
        return view('especialidades.index', compact('especialidades'));
    }


    public function create()
    {
        return view('especialidades.create');
    }

    public function store(Request $request)
    {   try{

         $request->validate([
            'nome' => 'required|unique:especialidades',
        ]);

        Especialidade::create([
            'nome' => $request->input('nome'),
        ]);

        return redirect()->route('especialidades.index')->with('success', 'Especialidade criada com sucesso.');

    }catch (\Exception $e){
        return redirect()->back()->with('error', 'Erro ao criar especialidade' . $e->getMessage());
    }

    }

    public function edit(Especialidade $especialidade)
{
    return view('especialidades.edit', compact('especialidade'));
}

    public function update(Request $request, Especialidade $especialidade)
    {
        try {
            $request->validate([
                'nome' => 'required|unique:especialidades,nome,' . $especialidade->id,
            ]);

            $especialidade->update([
                'nome' => $request->input('nome'),

            ]);

            return redirect()->route('especialidades.index')->with('success', 'Especialidade atualizada com sucesso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao atualizar ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {   try{
        $especialidades = Especialidade::findOrFail($id);
        $especialidades->delete();

        return redirect()->route('especialidades.index')->with('success', 'Especialidade excluída com sucesso.');
    }catch (\Exception $e){
        return redirect()->back()->with('error', 'Erro ao excluir Especialidade ' . $e->getMessage());
    }

    }

    public function medicos(Especialidade $especialidade)
{
    $medicos = $especialidade->medicos;

    return view('especialidades.medicos', [
        'especialidade' => $especialidade,
        'medicos' => $medicos,
    ]);
}

}
