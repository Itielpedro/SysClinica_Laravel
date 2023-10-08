@extends('layout')

@section('content')
<div class="container">
    <h1>Criar Especialidade</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('especialidades.store') }}">
        @csrf
        <div class="form-group">
            <label for="nome">Nome da Especialidade</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-outline-primary">Salvar <i class="fa-solid fa-floppy-disk"></i></button>
    </form>
</div>
@endsection
