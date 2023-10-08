@extends('layout')

@section('content')
<div class="container col-md-8">
    <h1 class="mt-3 mb-3">Agendar Consulta</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('agendamentos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" class="form-control" id="data" name="data" required>
        </div>

        <div class="form-group">
            <label for="hora">Hora</label>
            <select class="form-control" id="hora" name="hora" required>
                @foreach($horarios as $horario)
                <option value="{{ $horario }}">{{ $horario }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="paciente_id">Paciente</label>
            <select class="form-control" id="paciente_id" name="paciente_id" required>
                @foreach ($pacientes as $paciente)
                <option value="{{ $paciente->id }}">{{ $paciente->id. " " .$paciente->nome. " " .$paciente->telefone }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="medico_id">Médico</label>
            <select class="form-control" id="medico_id" name="medico_id" required>
                @foreach ($medicos as $medico)
                <option value="{{ $medico->id }}">{{$medico->id. " " .$medico->nome. " " .$medico->crm. " " .$medico->especialidade->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tipo_consulta">Tipo de Consulta</label>
            <select class="form-control" id="tipo_consulta" name="tipo_consulta" required>
                <option value="Plano">Plano</option>
                <option value="Particular">Particular</option>
            </select>
        </div>

        <div class="form-group">
            <label for="retorno">É Retorno?</label>
            <select class="form-control" id="retorno" name="retorno" required>
                <option value="Sim">Sim</option>
                <option value="Não">Não</option>
            </select>
        </div>

        <button type="submit" class="btn btn-outline-success mb-3 col-md-12">Agendar Consulta <i class="fa-solid fa-floppy-disk"></i></button>
    </form>
</div>
@endsection
