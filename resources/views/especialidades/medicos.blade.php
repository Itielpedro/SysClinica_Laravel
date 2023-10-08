@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(isset($medicos) && count($medicos) > 0)
                <h1 class="mt-3 mb-3">Médicos na Especialidade {{ $especialidade->nome }}</h1>
                <div class="row">
                    @foreach ($medicos as $medico)
                        <div class=" col-md-4 mb-4 text-center">
                            <div class="card bg-success text-white">
                                <div class="img-fluid card-img-container">
                                <img src="{{ Storage::url($medico->foto) }}" class="img card-img-top" alt="{{$medico->nome}}">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $medico->nome }}</h5>
                                    <p class="card-text">CPF: {{ $medico->cpf }}</p>
                                    <p class="card-text">Email: {{ $medico->email }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p>Nenhum médico na Especialidade: {{ $especialidade->nome }}</p>
            @endif
            <a href="{{ route('especialidades.index') }}" class="btn btn-outline-primary mt-3 mb-3 fs-5">Voltar para a lista de especialidades <i class="fa-solid fa-arrow-left"></i></a>
        </div>
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s;
        border-radius: 10px;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-img-container {
        overflow: hidden;
        height: 300px;
    }


</style>

@endsection
