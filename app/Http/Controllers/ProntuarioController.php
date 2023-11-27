<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Prontuario;

class ProntuarioController extends Controller
{
    public function index(){
        $prontuarios = Prontuario::all();

        return view('prontuarios.index', compact('prontuarios'));
    }

    public function show($id)
{
    $prontuario = Prontuario::with(['consultas' => function ($query) {
        $query->where('status', 'confirmado');
    }])->find($id);

    return view('prontuarios.show', compact('prontuario'));
}
}
