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
    <table class="table fs-5">
        <thead>
            <tr>
                <th>Nome Paciente</th>
                <th>CPF do Paciente</th>
                <th>Detalhes</th>
                <th>Relatório</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prontuarios as $prontuario)
            <tr>
                <td>{{ $prontuario->paciente->nome }}</td>
                <td>{{ $prontuario->paciente->cpf }}</td>
                <td class="col-md-1 text-center">
                    <a href="{{ route('prontuarios.show', $prontuario->id) }}" class="btn btn-outline-primary"><i class="fa-solid fa-circle-info"></i></a>
                </td>
                <td class="col-md-1">
                    <a target="_blank" href="{{ route('relatorios.prontuarios', ['id' => $prontuario->id]) }}" class="btn btn-outline-primary btn-block"><i class="fa-solid fa-print"></i></a>
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
