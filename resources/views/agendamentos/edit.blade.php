@extends('layout')

@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js" integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('content')
<div class="container col-md-8">
    <h1 class="mt-3 mb-3">Editar Agendamento</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('agendamentos.update', $agendamento->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="data">Data</label>
            <input type="date" class="form-control" id="data" name="data" value="{{ \Carbon\Carbon::parse($agendamento->data)->format('Y-m-d') }}" required>
        </div>


        <div class="form-group">
            <label for="hora">Hora</label>
            <select class="form-control" id="hora" name="hora" required>
                @foreach($horarios as $horario)
                <option value="{{ $horario }}" {{ $agendamento->hora == $horario ? 'selected' : '' }}>
                    {{ $horario }}
                </option>
                @endforeach
            </select>
        </div>


        <div class="form-group">
            <label for="paciente_id">Paciente</label>
            <select class="form-control" id="paciente_id" name="paciente_id" required>
                @foreach ($pacientes as $paciente)
                <option value="{{ $paciente->id }}" {{ $agendamento->paciente_id == $paciente->id ? 'selected' : '' }}>
                    {{ $paciente->id. " " .$paciente->nome. " " .$paciente->telefone }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="medico_id">Médico</label>
            <select class="form-control" id="medico_id" name="medico_id" required>
                @foreach ($medicos as $medico)
                <option value="{{ $medico->id }}" {{ $agendamento->medico_id == $medico->id ? 'selected' : '' }}>
                    {{$medico->id. " " .$medico->nome. " " .$medico->crm. " " .$medico->especialidade->nome }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="retorno">Tipo de Consulta</label>
            <select class="form-control" id="tipo_consulta" name="tipo_consulta" required>
                <option value="Plano" {{ $agendamento->tipo_consulta == 'Plano' ? 'selected' : '' }}>Plano</option>
                <option value="Particular" {{ $agendamento->tipo_consulta == 'Particular' ? 'selected' : '' }}>Particular</option>
            </select>
        </div>

        <div class="form-group">
            <label for="retorno">É Retorno?</label>
            <select class="form-control" id="retorno" name="retorno" required>
                <option value="Sim" {{ $agendamento->retorno == 'Sim' ? 'selected' : '' }}>Sim</option>
                <option value="Não" {{ $agendamento->retorno == 'Não' ? 'selected' : '' }}>Não</option>
            </select>
        </div>


        <button href="submit" class="btn btn-outline-primary mb-3 col-md-12">Atualizar Agendamento <i class="fa-solid fa-floppy-disk"></i></button>
    </form>
</div>
@endsection
