<!-- resources/views/dashboard.blade.php -->

@extends('layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Barra lateral (menu) -->
        @include('partials.sidebar') <!-- Você pode criar uma partial para a barra lateral -->

        <!-- Conteúdo principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Título da página -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Painel de Controle</h1>
            </div>

            <!-- Conteúdo do dashboard -->
            <div class="row">
                <div class="col-md-6">
                    <!-- Widget 1: Número de médicos cadastrados -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Número de Médicos Cadastrados</h5>
                            <p class="card-text">{{ $numeroMedicos }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Widget 2: Data -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data</h5>
                            <p class="card-text">{{ $dataAtual }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Widget 3: Número de Pacientes Cadastrados -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Número de Pacientes Cadastrados</h5>
                            <p class="card-text">{{ $numeroPacientes }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Widget 4: Número de Pacientes Agendados para o Dia -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Número de Pacientes Agendados para Hoje</h5>
                            <p class="card-text">{{ $numeroPacientesAgendados }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- Widget 5: 3 Maiores Especialidades Requisitadas -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">3 Maiores Especialidades Requisitadas (Mês Atual)</h5>
                            <ul class="list-group">
                                @foreach ($topEspecialidades as $especialidade)
                                <li class="list-group-item">{{ $especialidade->nome }} - {{ $especialidade->total }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
