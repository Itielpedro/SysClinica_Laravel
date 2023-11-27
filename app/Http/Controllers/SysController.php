<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Especialidade;
use App\Models\Funcionario;
use App\Models\Agendamento;
use Illuminate\Support\Carbon;


class SysController extends Controller
{
    public function index()
    {
        $maioresEspecialidadesDia = $this->getMaioresEspecialidadesDia();
        $maioresEspecialidadesMes = $this->getMaioresEspecialidadesMes('month');

        $numeroMedicos = Medico::count();

        $dataAtual = Carbon::now()->toDateString();

        $numeroPacientes = Paciente::count();

        $numeroPacientesAgendados = Agendamento::whereDate('data', $dataAtual)->count();

        $numeroFuncionarios = Funcionario::count();


        return view('home', compact('numeroMedicos', 'dataAtual', 'numeroPacientes', 'numeroPacientesAgendados', 'maioresEspecialidadesDia',  'maioresEspecialidadesMes', 'numeroFuncionarios'));
    }

    private function getMaioresEspecialidadesMes($periodo)
{
    $maioresEspecialidadesMes = Especialidade::select('especialidades.id', 'especialidades.nome')
        ->withCount(['medicos as agendamentos_count' => function ($query) {
            $query->join('agendamentos', 'medicos.id', '=', 'agendamentos.medico_id')
                ->whereBetween('agendamentos.data', [
                    now()->startOfMonth(),
                    now()->endOfMonth(),
                ]);
        }])
        ->orderByDesc('agendamentos_count')
        ->take(3)
        ->get();

    return $maioresEspecialidadesMes;
}



private function getMaioresEspecialidadesDia()
{
    $dataAtual = now()->format('Y-m-d');

    $maioresEspecialidadesDia = Especialidade::select('especialidades.id', 'especialidades.nome')
        ->withCount(['medicos as agendamentos_count' => function ($query) use ($dataAtual) {
            $query->join('agendamentos', 'medicos.id', '=', 'agendamentos.medico_id')
                ->whereDate('agendamentos.data', $dataAtual);
        }])
        ->orderByDesc('agendamentos_count')
        ->take(3)
        ->get();

    return $maioresEspecialidadesDia;
}
}
