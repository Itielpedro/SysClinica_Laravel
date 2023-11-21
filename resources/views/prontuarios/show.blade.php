

@extends('layout')

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>

<script>
    $(document).ready(function() {
        $('#prontuarioTabs a').on('click', function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>
@endsection

@section('content')
<div class="container mt-5">
    <ul class="nav nav-tabs nav-pills nav-fill" id="prontuarioTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="cabecalho-tab" data-toggle="tab" href="#cabecalho" role="tab" aria-controls="cabecalho" aria-selected="true">Cabeçalho</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="consultas-tab" data-toggle="tab" href="#consultas" role="tab" aria-controls="consultas" aria-selected="false">Detalhes</a>
        </li>
    </ul>
    <div class="tab-content mt-2" id="prontuarioTabsContent">
        <div class="tab-pane fade show active" id="cabecalho" role="tabpanel" aria-labelledby="cabecalho-tab">
            <h2 class="mt-3">Cabeçalho do Prontuário</h2>
            <table class="table text-center mt-5">
                <thead>
                    <tr>
                        <th>Código do Prontuário</th>
                        <th>Data de Cadastro</th>
                        <th>Código do Paciente</th>
                        <th>Nome Paciente</th>
                        <th>CPF do Paciente</th>
                        <th>Telefone do Paciente</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $prontuario->id }}</td>
                        <td>{{ $prontuario->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>{{ $prontuario->paciente->id }}</td>
                        <td>{{ $prontuario->paciente->nome }}</td>
                        <td>{{ $prontuario->paciente->cpf }}</td>
                        <td>{{ $prontuario->paciente->telefone }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="tab-pane fade" id="consultas" role="tabpanel" aria-labelledby="consultas-tab">
            <h2 class="mt-3">Listagem de Consultas</h2>

            <table class="table text-center mt-5">
                <thead>
                    <tr>
                        <th>Data da Consulta</th>
                        <th>Hora da Consulta</th>
                        <th>Médico</th>
                        <th>Detalhes</th>

                    </tr>
                </thead>
                <tbody>
                    @if(count($prontuario->consultas) > 0)
                    @foreach($prontuario->consultas as $consulta)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($consulta->data)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($consulta->hora)->format('H:i:s') }}</td>
                        <td>{{ $consulta->medico->nome }}</td>
                        <td class="col-md-2">
                            <button class="btn btn-outline-primary " data-toggle="modal" data-target="#detalhesModal{{ $consulta->id }}"><i class="fa-solid fa-circle-info ml-1"></i>
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="detalhesModal{{ $consulta->id }}" tabindex="-1" aria-labelledby="detalhesModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detalhesModalLabel">Detalhes da Consulta</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                <div class="modal-body">
                                    @foreach ($consulta->atendimentos as $atendimento)
                                    <div class="form-group">
                                        <label for="medico_id">Procedimento</label>
                                        <input type="text" class="form-control" id="procedimento" name="procedimento" value="{{ $atendimento->procedimento->descricao }}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="analise">Análise do Paciente</label>
                                        <textarea class="form-control " id="analise" name="analise" rows="4" readonly >{{ $atendimento->analise}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="diagnostico">Diagnóstico</label>
                                        <textarea class="form-control" id="diagnostico" name="diagnostico" rows="4" readonly>{{ $atendimento->diagnostico }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="receituario">Receituário</label>
                                        <textarea class="form-control" id="receituario" name="receituario" rows="4" readonly>{{ $atendimento->receituario }}</textarea>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Fechar <i class="fa-solid fa-circle-xmark"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    @else
                    <p>Nenhuma consulta realizada.</p>
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
