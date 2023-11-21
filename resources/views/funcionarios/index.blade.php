@extends('layout')

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@section('content')
<div class="container">
    <h1 class="mt-3 mb-3">Funcionários</h1>
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
    <a href="{{ route('funcionarios.index') }}" class="btn btn-outline-secondary mb-3">Limpar Pesquisa <i class="fa-regular fa-trash-can"></i></a>
    @elseif(!empty($funcionarios))
    <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#modalBuscaFuncionarios">Pesquisar Funcionários <i class="fa-solid fa-magnifying-glass"></i></button>
    @endif

    <!-- Modal de Busca -->
    <div class="modal fade" id="modalBuscaFuncionarios" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Buscar Funcionários</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('funcionarios.search') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="termo">Termo de Busca</label>
                            <input type="text" class="form-control" id="termo" name="termo" placeholder="Digite o termo de busca(Nome, CPF ou Tipo)">
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Buscar <i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($funcionarios) && count($funcionarios) > 0)
    <table class="table text-center fs-5">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome Completo</th>
                <th>CPF</th>
                <th>Cargo</th>
                <th>Detalhes</th>
                <th>Ficha de Cadastro</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($funcionarios as $funcionario)
            <tr>
                <td class="col-1">
                    <div>
                        <img src="{{ Storage::url($funcionario->foto) }}" class="img-fluid card-img-top" alt="Foto do Funcionário" >
                    </div>
                </td>
                <td>{{ $funcionario->nome }}</td>
                <td>{{ $funcionario->cpf }}</td>
                <td>{{ $funcionario->cargo }}</td>
                <td class="col-md-1">
                    <a href="{{ route('funcionarios.show', $funcionario->id) }}" class="btn btn-outline-info btn-block"><i class="fa-solid fa-circle-info"></i></a>
                </td>
                <td class="col-md-1">
                    <a href="{{ route('relatorios.funcionarios', ['id' => $funcionario->id]) }}" class="btn btn-outline-primary btn-block" target="_blank"><i class="fa-solid fa-print"></i></a>
                </td>
                <td class="col-md-1">
                    <a href="{{ route('funcionarios.edit', $funcionario->id) }}" class="btn btn-outline-warning btn-block"><i class="fa-regular fa-pen-to-square"></i></a>
                </td>
                <td class="col-md-1">
                    <form action="{{ route('funcionarios.destroy', $funcionario->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este funcionário?');">
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
    <p>Nenhum Funcionário cadastrado</p>
    @endif

    @if(isset($termo))

    @else
    <div class="row mt-3 col-3">
        <a href="{{ route('funcionarios.create') }}" class="btn btn-outline-success fs-6 mb-3">Cadastrar Funcionário <i class="fa-solid fa-user-plus"></i></a>
    </div>
    @endif
</div>
@endsection
