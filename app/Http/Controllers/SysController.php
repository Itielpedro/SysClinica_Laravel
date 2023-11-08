<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Especialidade;
use App\Models\Funcionario;
use App\Models\Agendamento;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
        $dataAtual = now();
        $mes = date('m');
        $intervalo = $periodo === 'day' ? '1 day' : '1 month';

        $maioresEspecialidades = Especialidade::select('id', 'nome')
            ->withCount('agendamentos')
            ->orderByDesc('agendamentos_count')
            ->take(3)
            ->get();

        return $maioresEspecialidades;
    }


    private function getMaioresEspecialidadesDia()
    {

        $dataAtual = now();
        $maioresEspecialidadesDia = Especialidade::with(['medicos.agendamentos' => function ($query) use ($dataAtual) {
            $query->whereDate('data', $dataAtual);
        }])->get();

        $maioresEspecialidadesDia = $maioresEspecialidadesDia->sortByDesc(function ($especialidade) {
            return $especialidade->medicos->sum('agendamentos_count');
        })->take(3);
        return $maioresEspecialidadesDia;
    }


}
