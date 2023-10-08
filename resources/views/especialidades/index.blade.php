@extends('layout')

@section('content')
<div class="container">
    <h1 class="mt-3 mb-3">Especialidades</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            @if(count($especialidades) > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Ver Medicos</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($especialidades as $especialidade)
                            <tr>
                                <td>{{ $especialidade->nome }}</td>
                                <td>

                                    <a class="btn btn-outline-primary" href="{{ route('especialidades.medicos', $especialidade->id) }}">Medicos {{ $especialidade->nome }} <i class="fa-solid fa-circle-info"></i></a><td>
                                    <a href="{{ route('especialidades.edit', $especialidade->id) }}" class="btn btn-outline-warning">Editar <i class="fa-regular fa-pen-to-square"></i></a>
                                    </td>
                                    <td>
                                    <form action="{{route('especialidades.destroy',  $especialidade->id)}}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">Excluir <i class="fa-regular fa-trash-can"></i></button>
                                    </form>
                                    </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Nenhuma Especialidade cadastrada</p>
            @endif
        </div>
    </div>
    <div class="row mt-3">
        <form action="{{route('especialidades.create')}}" method="GET">
            @csrf
            <button type="submit" class="btn btn-outline-success">Criar Especialidade <i class="fa-solid fa-plus"></i></button>
        </form>
    </div>
</div>
@endsection
