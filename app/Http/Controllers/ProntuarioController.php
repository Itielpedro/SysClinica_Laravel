<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prontuario;
use App\Models\Paciente;

class ProntuarioController extends Controller
{
    public function index(){
        $prontuarios = Prontuario::all();

        return view('prontuarios.index', compact('prontuarios'));
    }

    public function show($id)
{
    $prontuario = Prontuario::with('consultas')->find($id);

    return view('prontuarios.show', compact('prontuario'));
}
}
