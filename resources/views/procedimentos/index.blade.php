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
    <h1 class="mt-3 mb-3">Procedimentos</h1>

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
    <a href="{{ route('procedimentos.index') }}" class="btn btn-outline-secondary mb-3">Limpar Pesquisa <i class="fa-regular fa-trash-can"></i></a>
    @elseif(!empty($procedimentos))
    <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#modalBuscaProcedimentos">Pesquisar Procedimentos <i class="fa-solid fa-magnifying-glass"></i></button>
    @endif


    <div class="modal fade" id="modalBuscaProcedimentos" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Buscar Procedimentos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('procedimentos.search') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="termo">Termo de Busca</label>
                            <input type="text" class="form-control" id="termo" name="termo" placeholder="Digite o termo de busca (Descrição)">
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Buscar <i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if(!empty($procedimentos) && count($procedimentos) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Observações</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($procedimentos as $procedimento)
            <tr>
                <td>{{ $procedimento->descricao }}</td>
                <td>R$ {{ $procedimento->valor }}</td>
                <td>{{ $procedimento->observacoes }}</td>
                <td>
                    <a href="{{ route('procedimentos.edit', $procedimento->id) }}" class="btn btn-outline-warning">Editar <i class="fa-regular fa-pen-to-square"></i></a>
                </td>
                <td>
                    <form action="{{ route('procedimentos.destroy', $procedimento->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir este procedimento?');">
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
    <p>Nenhum procedimento cadastrado.</p>
    @endif
    @if(isset($termo))

    @else
    <div class="mt-3 mb-3">
        <form action="{{route('procedimentos.create')}}" method="GET">
            @csrf
            <button type="submit" class="btn btn-outline-success">Novo Procedimento <i class="fa-solid fa-plus"></i></button>
        </form>
    </div>
    @endif

@endsection
