<!-- resources/views/prontuarios/show.blade.php -->

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
                        <th>Procedimentos</th>
                        <th>Médico</th>

                    </tr>
                </thead>
                <tbody>
                    @if(count($prontuario->consultas) > 0)

                    @foreach($prontuario->consultas as $consulta)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($consulta->data)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($consulta->hora)->format('H:i:s') }}</td>
                        <td>{{ $consulta->procedimentos }}</td>
                        <td>{{ $consulta->medico->nome }}</td>
                     </tr>
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
