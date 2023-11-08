<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EspecialidadesController;
use App\Http\Controllers\MedicosController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\SysController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ProcedimentoController;
use App\Http\Controllers\ProntuarioController;

// Rota Inicial
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    //Home
    Route::get('/home', [SysController::class, 'index'])->name('home');

    // Especialidades
    Route::get('/especialidades', [EspecialidadesController::class, 'index'])->name('especialidades.index');
    Route::match(['get', 'post'], '/especialidades/create', [EspecialidadesController::class, 'create'])->name('especialidades.create');
    Route::post('/especialidades/store', [EspecialidadesController::class, 'store'])->name('especialidades.store');
    Route::get('/especialidades/{especialidade}/editar', [EspecialidadesController::class, 'edit'])->name('especialidades.edit');
    Route::put('/especialidades/{especialidade}',  [EspecialidadesController::class, 'update'])->name('especialidades.update');
    Route::delete('/especialidades/destroy/{id}', [EspecialidadesController::class, 'destroy'])->name('especialidades.destroy');
    Route::get('/especialidades/{especialidade}/medicos',  [EspecialidadesController::class, 'medicos'])->name('especialidades.medicos');

    //Médicos
    Route::get('/medicos', [MedicosController::class, 'index'])->name('medicos.index');
    Route::match(['get', 'post'], '/medicos/create', [MedicosController::class, 'create'])->name('medicos.create');
    Route::post('/medicos',  [MedicosController::class, 'store'])->name('medicos.store');
    Route::get('/medicos/{id}', [MedicosController::class, 'show'])->name('medicos.show');
    Route::get('/medicos/{medico}/edit',  [MedicosController::class, 'edit'])->name('medicos.edit');
    Route::put('/medicos/{medico}',  [MedicosController::class, 'update'])->name('medicos.update');
    Route::delete('/medicos/{medico}',  [MedicosController::class, 'destroy'])->name('medicos.destroy');
    Route::post('/medicos/search', [MedicosController::class, 'search'])->name('medicos.search');

    //Pacientes
    Route::get('/pacientes', [PacienteController::class, 'index'])->name('pacientes.index');
    Route::match(['get', 'post'], '/paciente/create', [PacienteController::class, 'create'])->name('pacientes.create');
    Route::post('/pacientes',  [PacienteController::class, 'store'])->name('pacientes.store');
    Route::get('/pacientes/{paciente}/edit',  [PacienteController::class, 'edit'])->name('pacientes.edit');
    Route::get('/paciente/{id}', [PacienteController::class, 'show'])->name('pacientes.show');
    Route::put('/pacientes/{paciente}',  [PacienteController::class, 'update'])->name('pacientes.update');
    Route::delete('/pacientes/{paciente}',  [PacienteController::class, 'destroy'])->name('pacientes.destroy');
    Route::post('/pacientes/search', [PacienteController::class, 'search'])->name('pacientes.search');

    //Funcionários
    Route::get('/funcionarios', [FuncionarioController::class, 'index'])->name('funcionarios.index');
    Route::match(['get', 'post'], '/funcionarios/create', [FuncionarioController::class, 'create'])->name('funcionarios.create');
    Route::post('/funcionarios', [FuncionarioController::class, 'store'])->name('funcionarios.store');
    Route::get('/funcionarios/{id}', [FuncionarioController::class, 'show'])->name('funcionarios.show');
    Route::get('/funcionarios/{id}/edit', [FuncionarioController::class, 'edit'])->name('funcionarios.edit');
    Route::put('/funcionarios/{id}', [FuncionarioController::class, 'update'])->name('funcionarios.update');
    Route::delete('/funcionarios/{funcionario}', [FuncionarioController::class, 'destroy'])->name('funcionarios.destroy');
    Route::post('/funcionarios/search', [FuncionarioController::class, 'search'])->name('funcionarios.search');

    //Agendamentos
    Route::get('/agendamentos', [AgendamentoController::class, 'index'])->name('agendamentos.index');
    Route::get('/agendamentos/create', [AgendamentoController::class, 'create'])->name('agendamentos.create');
    Route::post('/agendamentos', [AgendamentoController::class, 'store'])->name('agendamentos.store');
    Route::get('/agendamentos/{agendamento}/edit', [AgendamentoController::class, 'edit'])->name('agendamentos.edit');
    Route::put('/agendamentos/{agendamento}', [AgendamentoController::class, 'update'])->name('agendamentos.update');
    Route::delete('/agendamentos/{agendamento}', [AgendamentoController::class, 'destroy'])->name('agendamentos.destroy');
    Route::post('/agendamentos/search', [AgendamentoController::class, 'search'])->name('agendamentos.search');
    Route::post('/confirmar-agendamento/{id}',  [AgendamentoController::class, 'confirmarAgendamento'])->name('agendamentos.confirmar');

    //Consultas
    Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.index');
    Route::post('/consultas/search', [ConsultaController::class, 'search'])->name('consultas.search');

    //Procedimentos
    Route::get('/procedimentos', [ProcedimentoController::class, 'index'])->name('procedimentos.index');
    Route::get('/procedimentos/create', [ProcedimentoController::class, 'create'])->name('procedimentos.create');
    Route::post('/procedimentos', [ProcedimentoController::class, 'store'])->name('procedimentos.store');
    Route::get('/procedimentos/{procedimento}/edit', [ProcedimentoController::class, 'edit'])->name('procedimentos.edit');
    Route::put('/procedimentos/{procedimento}', [ProcedimentoController::class, 'update'])->name('procedimentos.update');
    Route::delete('/procedimentos/{procedimento}', [ProcedimentoController::class, 'destroy'])->name('procedimentos.destroy');
    Route::post('/procedimentos/search', [ProcedimentoController::class, 'search'])->name('procedimentos.search');

    //Prontuario
    Route::get('/prontuarios', [ProntuarioController::class, 'index'])->name('prontuarios.index');
    Route::get('/prontuarios/{prontuario}', [ProntuarioController::class, 'show'])->name('prontuarios.show');
    Route::get('/prontuarios/{prontuario}/edit', [ProntuarioController::class, 'edit'])->name('prontuarios.edit');
    Route::put('/prontuarios/{prontuario}', [ProntuarioController::class, 'update'])->name('prontuarios.update');
    Route::delete('/prontuarios/{prontuario}', [ProntuarioController::class, 'destroy'])->name('prontuarios.destroy');
});
