<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consulta;

class ConsultaController extends Controller
{
    public function index()
    {

        try {
            $consultas = Consulta::with(['paciente', 'medico'])
                ->orderBy('data', 'asc')->orderBy('hora', 'asc')
                ->get();

            return view('consultas.index', compact('consultas'));
        } catch (\Exception $e) {
            return redirect()->route('consultas.index')->with('error', 'Erro ao obter os consultas.');
        }
    }

    public function search(Request $request)
    {
        try {
            $termo = $request->input('termo');

            $resultados = Consulta::where(function ($query) use ($termo) {
                $query->where('data', 'like', "%$termo%")
                    ->orWhereHas('paciente', function ($query) use ($termo) {
                        $query->where('nome', 'like', "%$termo%");
                    })
                    ->orWhereHas('medico', function ($query) use ($termo) {
                        $query->where('nome', 'like', "%$termo%")
                            ->orWhereHas('especialidade', function ($query) use ($termo) {
                                $query->where('nome', 'like', "%$termo%");
                            });
                    })->orWhere('tipo_consulta', 'like', "%$termo%")
                    ->orWhere('retorno', 'like', "%$termo%");
            })->orderBy('data')->orderBy('hora')->get();

            return view('consultas.index', ['consultas' => $resultados, 'termo' => $termo]);
        } catch (\Exception $e) {
            return redirect()->route('consultas.index')->with('error', 'Erro ao pesquisar consulta: ' . $e->getMessage());
        }
    }

}
