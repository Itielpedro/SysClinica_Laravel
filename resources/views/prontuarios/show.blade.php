@extends('layout')

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>

<script>
    $(document).ready(function () {
        $('#prontuarioTabs a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>
@endsection

@section('content')
<div class="container mt-5">
    <ul class="nav nav-tabs" id="prontuarioTabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="cabecalho-tab" data-toggle="tab" href="#cabecalho" role="tab" aria-controls="cabecalho" aria-selected="true">Cabeçalho</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="consultas-tab" data-toggle="tab" href="#consultas" role="tab" aria-controls="consultas" aria-selected="false">Consultas</a>
        </li>
    </ul>
    <div class="tab-content mt-2" id="prontuarioTabsContent">
        <div class="tab-pane fade show active" id="cabecalho" role="tabpanel" aria-labelledby="cabecalho-tab">
            <h2>Cabeçalho do Prontuário</h2>

            @foreach ($prontuario as $pront)
                <p>Código: </p>
                <p>Data de Cadastro: {{ $pront->created_at->format('d/m/Y H:i:s') }}</p>
                <p>Cod Paciente: {{ $pront->paciente->id }}</p>
                <p>Nome: {{ $pront->paciente->nome }}</p>
                <p>CPF: {{ $pront->paciente->cpf }}</p>
                <p>Telefone: {{ $pront->paciente->telefone }}</p>
           @endforeach
        </div>
        <div class="tab-pane fade" id="consultas" role="tabpanel" aria-labelledby="consultas-tab">
            <h2>Listagem de Consultas</h2>

        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#prontuarioTabs a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
</script>
@endsection

