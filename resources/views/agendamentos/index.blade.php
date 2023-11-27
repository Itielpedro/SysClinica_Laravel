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
    <h1 class="mt-3 mb-3">Agendamentos</h1>

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
    <a href="{{ route('agendamentos.index') }}" class="btn btn-outline-secondary mb-3">Limpar Pesquisa <i class="fa-regular fa-trash-can"></i></a>
    @elseif(!empty($agendamentos))
    <button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#modalBuscaAgendamentos">Pesquisar Agendamentos <i class="fa-solid fa-magnifying-glass"></i></button>

    <button type="button" class="btn btn-outline-dark col-md-3 mb-3" data-toggle="modal" data-target="#relatorioModal">Relatório <i class="fa-solid fa-print"></i></button>
    @endif



    <!-- Modal de Busca -->
    <div class="modal fade" id="modalBuscaAgendamentos" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Buscar Agendamentos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('agendamentos.search') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="termo">Termo de Busca</label>
                            <input type="text" class="form-control" id="termo" name="termo" placeholder="Digite o termo de busca (Data, Paciente, Médico, Especialidade, Tipo de Consulta, Retorno)">
                        </div>
                        <a target="_blank" class="btn btn-outline-primary">Buscar <i class="fa-solid fa-magnifying-glass"></i></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Relatório -->
<div class="modal fade" id="relatorioModal" tabindex="-1" role="dialog" aria-labelledby="relatorioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="relatorioModalLabel">Relatório</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('relatorios.agendamentos') }}" method="get" target="_blank">
                    <div class="form-group">
                        <label for="data_escolhida">Data:</label>
                        <input type="date" name="data_escolhida" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="especialidade_id">Especialidade:</label>
                        <select name="especialidade_id" class="form-control">
                        <option></option>
                            @foreach($especialidades as $especialidade)
                                <option value="{{ $especialidade->id }}">{{ $especialidade->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="medico_id">Médico:</label>
                        <select name="medico_id" class="form-control">
                        <option></option>
                            @foreach($medicos as $medico)
                                <option value="{{ $medico->id }}">{{ $medico->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Relatório <i class="fa-solid fa-print" formtarget="_blank"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>


    @if(!empty($agendamentos) && count($agendamentos) > 0)
    <table class="table text-center fs-5">
        <thead>
            <tr>
                <th>Data</th>
                <th>Hora</th>
                <th>Paciente</th>
                <th>Médico</th>
                <th>Especialidade</th>
                <th>Tipo de Consulta</th>
                <th>É Retorno?</th>
                <th>Confirmação</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($agendamentos as $agendamento)
            <tr>
                <td>{{ \Carbon\Carbon::parse($agendamento->data)->format('d/m/Y') }}</td>
                <td>{{ $agendamento->hora }}</td>
                <td>{{ $agendamento->paciente->nome }}</td>
                <td>{{ $agendamento->medico->nome }}</td>
                <td>{{ $agendamento->medico->especialidade->nome }}</td>
                <td>{{ $agendamento->tipo_consulta }}</td>
                <td>{{ $agendamento->retorno }}</td>
                <td class=" {{ $agendamento->status === 'confirmado' ? 'table-success' : 'table-danger' }}">
                    @if($agendamento->status == 'pendente')
                    <form class="mt-3" action="{{ route('agendamentos.confirmar', $agendamento->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-success btn-block"><i class="fa-regular fa-calendar-check ml-1"></i></button>
                    </form>
                    @else
                    <span class="text-success">Consulta Realizada</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('agendamentos.edit', $agendamento->id) }}" class="btn btn-outline-warning"><i class="fa-regular fa-pen-to-square ml-1"></i>
                    </a>
                </td>
                <td>
                    <form action="{{ route('agendamentos.destroy', $agendamento->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este agendamento?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger"><i class="fa-regular fa-trash-can ml-1"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>Nenhum agendamento cadastrado</p>
    @endif

    @if(isset($termo))

    @else
    <div class="row mt-3 col-3">
        <a href="{{ route('agendamentos.create') }}" class="btn btn-outline-success fs-6 mb-3">Agendar Consulta <i class="fa-solid fa-calendar-plus"></i></a>
    </div>
    @endif
</div>
@endsection
