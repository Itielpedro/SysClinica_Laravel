@extends('layout')

@section('content')
<div class="container">
    <h1>Cadastrar Atendimento</h1>

    @if($consulta)
    <form action="{{ route('atendimentos.store', $consulta->id) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="data_consulta">Data da Consulta:</label>
            <input type="text" value="{{\Carbon\Carbon::parse($consulta->data)->format('d/m/Y')}} - {{$consulta->hora}}" class="form-control" id="data_consulta" name="data_consulta" readonly>
        </div>

        <div class="form-group">
            <label for="medico_id">Médico:</label>
            <input type="text" class="form-control" id="medico_id" name="medico_id" value="{{ $consulta->medico_id . ' - ' . $consulta->medico->nome . ' - ' . $consulta->medico->especialidade->nome}}" readonly>
        </div>

        <div class="form-group">
            <label for="paciente_id">Paciente:</label>
            <input type="text" class="form-control" id="paciente_id" name="paciente_id" value="{{ $consulta->paciente_id . ' - ' . $consulta->paciente->nome . ' - ' . $consulta->paciente->cpf}}" readonly>
        </div>

        <div class="form-group">
            <label for="procedimento_id">Procedimento:</label>
            <select class="form-control" id="procedimento_id" name="procedimento_id" required>
                @foreach($procedimentos as $procedimento)
                <option value="{{ $procedimento->id }}">{{ $procedimento->descricao }} -  {{ $procedimento->valor }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="analise">Análise do Paciente:</label>
            <textarea class="form-control" id="analise" name="analise" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="diagnostico">Diagnóstico:</label>
            <textarea class="form-control" id="diagnostico" name="diagnostico" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="receituario">Receituários:</label>
            <textarea class="form-control" id="receituario" name="receituario" rows="4" required></textarea>
        </div>

        <button type="submit" class="btn btn-outline-success mb-5">Cadastrar Atendimento <i class="fa-solid fa-floppy-disk"></i></button>
    </form>
    @else
    <p>Consulta não encontrada.</p>
    @endif
</div>
@endsection
