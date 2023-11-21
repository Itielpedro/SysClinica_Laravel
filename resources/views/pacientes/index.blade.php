@extends('layout')

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@section('content')
<div class="container">
    <h1 class="mt-3 mb-3">Pacientes</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if(isset($termo))

    <p>Pesquisando por: "{{ $termo }}"</p>
    <a href="{{ route('pacientes.index') }}" class="btn btn-secondary mb-3">Limpar Pesquisa <i class="fa-regular fa-trash-can"></i></a>
    @elseif(!empty($pacientes))
    <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#modalBuscaPacientes">Pesquisar Pacientes <i class="fa-solid fa-magnifying-glass"></i></button>

    <a href="{{ route('relatorios.aniversariantes') }}" class="btn btn-outline-dark col-md-3 mb-3" target="_blank">Aniversariantes do Mês <i class="fa-solid fa-cake-candles"></i></a>

    @endif

    <div class="modal fade" id="modalBuscaPacientes" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Buscar Pacientes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('pacientes.search') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="termo">Termo de Busca</label>
                            <input type="text" class="form-control" id="termo" name="termo" placeholder="Digite o termo de busca(Nome, Cpf ou Email)">
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Buscar <i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>






    @if(!empty($pacientes) && count($pacientes) > 0)
    <table class="table text-center fs-5 col-md-12">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Cpf</th>
                <th>Informações Médicas</th>
                <th>Prontuário</th>
                <th>Detalhes</th>
                <th>Ficha de Cadastro</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pacientes as $paciente)
            <tr>
                <td class="col-1">
                    <div>
                        <img src="{{ Storage::url($paciente->foto) }}" class="img-fluid card-img-top" alt="Foto do Paciente" height="90" width="80">
                    </div>
                </td>
                <td>{{ $paciente->nome }}</td>
                <td>{{ $paciente->cpf }}</td>
                <td>{{$paciente->info_medica}}</td>
                <td class="col-md-1">
                    @if ($paciente->prontuario)
                    <a href="{{ route('prontuarios.show', ['prontuario' => $paciente->prontuario->id]) }}" class="btn btn-outline-secondary btn-block"><i class="fa-solid fa-clipboard-user"></i></a>
                    @else
                    <span class="text-muted">Sem prontuário</span>
                    @endif
                </td>
                <td class="col-md-1">
                    <a href="{{ route('pacientes.show', $paciente->id) }}" class="btn btn-outline-info btn-block"><i class="fa-solid fa-circle-info"></i></a>
                </td>
                <td class="col-md-1">
                    <a href="{{ route('relatorios.fichacadastro', ['id' => $paciente->id]) }}" class="btn btn-outline-primary btn-block" target="_blank"><i class="fa-solid fa-print" ></i></a>
                </td>
                <td class="col-md-1">
                    <a href="{{ route('pacientes.edit', $paciente->id) }}" class="btn btn-outline-warning btn-block"><i class="fa-regular fa-pen-to-square"></i></a>
                </td>
                <td class="col-md-1">
                    <form action="{{ route('pacientes.destroy', $paciente->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este paciente?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-block"><i class="fa-regular fa-trash-can"></i></button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Nenhum Paciente cadastrado</p>
    @endif

    @if(isset($termo))

    @else
    <div class="row mt-3 col-3">
        <a href="{{ route('pacientes.create') }}" class="btn btn-outline-success fs-5 mb-3">Cadastrar Paciente <i class="fa-solid fa-user-plus"></i></a>
    </div>
    @endif
</div>
@endsection
