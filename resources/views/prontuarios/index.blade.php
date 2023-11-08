@extends('layout')

@section('content')
    <div class="container">
        <h1 class="mt-3 mb-3">Prontuários</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($prontuarios && count($prontuarios) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome Paciente</th>
                        <th>CPF do Paciente</th>
                        <th>Detalhes</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prontuarios as $prontuario)
                        <tr>
                            <td>{{ $prontuario->paciente->nome }}</td>
                            <td>{{ $prontuario->paciente->cpf }}</td>
                            <td>
                                <a href="{{ route('prontuarios.show', $prontuario->id) }}" class="btn btn-outline-primary">Detalhes <i class="fa-solid fa-circle-info"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('prontuarios.edit', $prontuario->id) }}" class="btn btn-outline-warning">Editar <i class="fa-regular fa-pen-to-square"></i></a>
                            </td>
                            <td>
                                <form action="{{ route('prontuarios.destroy', $prontuario->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir este prontuário?');">
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
            <p>Nenhum prontuário cadastrado.</p>
        @endif

    </div>
@endsection
