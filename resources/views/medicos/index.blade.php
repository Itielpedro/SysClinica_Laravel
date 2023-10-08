@extends('layout')

@section('content')
<div class="container">
    <h1 class="mt-3 mb-3">Médicos</h1>
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
    <a href="{{ route('medicos.index') }}" class="btn btn-outline-secondary mb-3">Limpar Pesquisa <i class="fa-regular fa-trash-can"></i></a>
    @elseif(!empty($medicos))
    <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#modalBuscaMedicos">Pesquisar Médicos <i class="fa-solid fa-magnifying-glass"></i></button>
    @endif


    <div class="modal fade" id="modalBuscaMedicos" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Buscar Médicos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('medicos.search') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="termo">Termo de Busca</label>
                            <input type="text" class="form-control" id="termo" name="termo" placeholder="Digite o termo de busca(Nome, Cpf, Crm ou Especialidade)">
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Buscar <i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <table class="table text-center fs-5">
        @if(!empty($medicos) && count($medicos) > 0)
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Crm</th>
                <th>Especialidade</th>
                <th>Detalhes</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medicos as $medico)
            <tr>
                <td >
                    <div>
                    <img src="{{ Storage::url($medico->foto) }}" class="img-fluid card-img-top" alt="Foto" height="90" width="80">

                    </div>
                </td>
                <td>{{ $medico->nome }}</td>
                <td>{{ $medico->crm }}</td>
                <td>{{ $medico->especialidade->nome }}</td>
                <td class="col-md-2">
                    <a href="{{ route('medicos.show', $medico->id) }}" class="btn btn-outline-info">Detalhes <i class="fa-solid fa-circle-info"></i></a>
                </td>
                <td class="col-md-2">
                    <a href="{{ route('medicos.edit', $medico->id) }}" class="btn btn-outline-warning">Editar <i class="fa-regular fa-pen-to-square"></i></a>
                </td>
                <td class="col-md-2">
                    <form action="{{ route('medicos.destroy', $medico->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este médico?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Excluir <i class="fa-regular fa-trash-can"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Nenhum Médico cadastrado</p>
    @endif
    @if(isset($termo))

    @else
    <div class="row mt-3 col-3">
        <a href="{{ route('medicos.create') }}" class="btn btn-outline-success fs-5 mb-3">Cadastrar Médico <i class="fa-solid fa-user-plus"></i></a>
    </div>
    @endif
</div>
@endsection
