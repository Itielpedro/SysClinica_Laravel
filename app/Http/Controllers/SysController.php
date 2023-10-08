<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\Especialidade;
use App\Models\Funcionario;
use Illuminate\Support\Carbon;

class SysController extends Controller
{
    public function index()
    {
        $numeroMedicos = Medico::count();

        $dataAtual = Carbon::now()->toDateString();

        $numeroPacientes = Paciente::count();

        $numeroPacientesAgendados = 10;

        $numeroFuncionarios = Funcionario::count();

        $topEspecialidades = Especialidade::withCount('medicos')
            ->orderBy('medicos_count', 'desc')
            ->limit(3)
            ->get();

        return view('home', compact('numeroMedicos', 'dataAtual', 'numeroPacientes', 'numeroPacientesAgendados', 'topEspecialidades', 'numeroFuncionarios'));
    }
}
