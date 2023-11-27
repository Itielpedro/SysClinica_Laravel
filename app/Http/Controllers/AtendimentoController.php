<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Procedimento;
use App\Models\Consulta;
use App\Models\Atendimento;
use App\Models\Prontuario;

class AtendimentoController extends Controller
{
    public function create($id)
    {

        $procedimentos = Procedimento::all();
        $consulta = Consulta::findOrFail($id);

        return view('atendimentos.create', compact('procedimentos', 'consulta'));
    }

    public function store(Request $request, $consulta_id)
    {
        $consulta = Consulta::findOrFail($consulta_id);
        try {
            $validatedData = $request->validate([
                'procedimento_id' => 'required|exists:procedimentos,id',
                'analise' => 'required|string',
                'diagnostico' => 'required|string',
                'receituario' => 'required|string',

            ]);

            $atendimento = new Atendimento;
            $atendimento->consulta_id = $consulta_id;
            $atendimento->procedimento_id = $request->input('procedimento_id');
            $atendimento->analise = $request->input('analise');
            $atendimento->diagnostico = $request->input('diagnostico');
            $atendimento->receituario = $request->input('receituario');
            $atendimento->status = true;
            $atendimento->save();


            $consulta->status = 'confirmado';
            $consulta->update();

            $prontuario = Prontuario::where('paciente_id', $consulta->paciente_id)->first();
                if (!$prontuario) {
                    $prontuario = Prontuario::create([
                        'paciente_id' => $consulta->paciente_id,
                    ]);
                }

            return redirect()->route('consultas.index')->with('success', 'Atendimento cadastrado com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('consultas.index')->with('error', 'Erro ao cadastrar atendimento: ' . $e->getMessage());
        }
    }
}
