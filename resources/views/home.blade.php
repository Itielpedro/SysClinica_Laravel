<!-- resources/views/dashboard.blade.php -->

@extends('layout')


<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
<link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">


@section('content')
<div class="grey-bg container-fluid">
    <section id="minimal-statistics">
        <div class="row">
            <div class="col-12 mt-3 mb-3">
                <h2 class="success text-uppercase">Bem-vindo(a), {{ Auth::user()->name }}!</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex justify-content-between">
                                <div class="media-body  text-left">
                                    <h3 class="danger">DATA</h3>
                                    <h4 class="primary">{{ date('d/m/Y', strtotime($dataAtual)) }}</h4>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-calendar primary font-large-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex justify-content-between">
                                <div class="media-body  text-left">
                                    <h3 class="danger">MÉDICOS</h3>
                                    <h4 class="primary">{{ $numeroMedicos }}</h4>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-user primary font-large-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex justify-content-between">
                                <div class="media-body  text-left">
                                    <h3 class="danger">PACIENTES</h3>
                                    <h4 class="primary">{{ $numeroPacientes }}</h4>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-users primary font-large-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-sm-7 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex justify-content-between">
                                <div class="media-body  text-left">
                                    <h3 class="danger">FUNCIONARIOS</h3>
                                    <h4 class="primary">{{ $numeroFuncionarios }}</h4>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-users primary font-large-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex justify-content-between">
                                <div class="media-body text-left">
                                    <h3 class="danger">PACIENTES DO DIA {{ date('d/m/Y', strtotime($dataAtual)) }}</h3>
                                    <h4 class="primary">{{ $numeroPacientesAgendados}}</h4>
                                </div>
                                <div class="align-self-center">
                                    <i class="icon-book-open primary font-large-2"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex justify-content-between">
                                <div class="media-body  text-left">
                                    <h3 class="danger">TOP 3 ESPECIALIDADES DO MÊS</h3>
                                    <h4 class="primary">
                                        <ul>
                                            @foreach ($maioresEspecialidadesMes as $especialidade)
                                            <li class="list-group-item">{{ $especialidade->nome }} ({{ $especialidade->agendamentos_count }} agendamentos)</li>
                                            @endforeach
                                        </ul>
                                    </h4>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa-regular fa-star primary font-large-2 ml-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-sm-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex justify-content-between">
                                <div class="media-body  text-left">
                                    <h3 class="danger">TOP 3 ESPECIALIDADES DO DIA</h3>
                                    <h4 class="primary">
                                        <ul>
                                            @foreach ($maioresEspecialidadesDia as $especialidade)
                                            <li class="list-group-item">{{ $especialidade->nome }} ({{ $especialidade->medicos->sum('agendamentos_count') }} agendamentos)</li>
                                            @endforeach
                                        </ul>
                                    </h4>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa-regular fa-star primary font-large-2 ml-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @endsection
