<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prontuario;

class ProntuarioController extends Controller
{
    public function index(){
        $prontuarios = Prontuario::all();

        return view('prontuarios.index', compact('prontuarios'));
    }

    public function show($pacienteId)
    {
        $prontuario = Prontuario::where('paciente_id', $pacienteId)->first();

        return view('prontuarios.show', compact('prontuario'));
    }
}
