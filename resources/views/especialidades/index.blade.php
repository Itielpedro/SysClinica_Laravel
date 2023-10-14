@extends('layout')

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script>
    $(document).ready(function() {

        $('#especialidadesTabs a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        $('#especialidadesTabs a').on('shown.bs.tab', function(e) {
            var especialidadeId = $(e.target).data('especialidade-id');

        });
    });
</script>
@endsection

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@elseif(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="container">
    <h1 class="mt-3 mb-3">Especialidades</h1>

    <div class="mt-3 mb-3">
        <form action="{{route('especialidades.create')}}" method="GET">
            @csrf
            <button type="submit" class="btn btn-outline-success">Criar Especialidade <i class="fa-solid fa-plus"></i></button>
        </form>
    </div>
    <ul class="nav nav-tabs" id="especialidadesTabs">
        @foreach ($especialidades as $especialidade)
        <li class="nav-item">
            <a class="nav-link" id="especialidade{{$especialidade->id}}" data-toggle="tab" href="#especialidadeTab{{$especialidade->id}}" data-especialidade-id="{{$especialidade->id}}">
                {{ $especialidade->nome }}
            </a>
        </li>
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach ($especialidades as $especialidade)
        <div id="especialidadeTab{{$especialidade->id}}" class="tab-pane fade">
            <h3>Médicos na Especialidade {{ $especialidade->nome }}</h3>
            @if(count($especialidade->medicos) > 0)
            <div class="row">
                @foreach ($especialidade->medicos as $medico)
                <div class="col-md-4 mb-4 text-center">
                    <div class="card bg-success text-white">
                        <div class="img-fluid card-img-container">
                            <img src="{{ Storage::url($medico->foto) }}" class="img card-img-top mt-3" alt="{{$medico->nome}}" style="width: 200px;height: 200px;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $medico->nome }}</h5>
                            <p class="card-text">CRM: {{ $medico->crm }}</p>
                            <p class="card-text">Email: {{ $medico->email }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p>Nenhum médico cadastrado nesta especialidade.</p>
            @endif

            <a href="{{ route('especialidades.edit', $especialidade->id) }}" class="btn btn-outline-warning mb-3">Editar Especialidade <i class="fa-regular fa-pen-to-square"></i></a>

            <form action="{{ route('especialidades.destroy', $especialidade->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Tem certeza que deseja excluir esta especialidade?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger mb-3">Excluir Especialidade <i class="fa-regular fa-trash-can"></i></button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection
