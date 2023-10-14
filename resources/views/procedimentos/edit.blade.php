@extends('layout')

@section('content')
<div class="container">
    <h1 class="mt-3 mb-3">Editar Procedimento</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('procedimentos.update', $procedimento->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ old('descricao', $procedimento->descricao) }}" required>
        </div>
        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="text" class="form-control" id="valor" name="valor" value="{{ old('valor', $procedimento->valor) }}" required>
        </div>
        <div class="form-group">
            <label for="observacoes">Observações Gerais:</label>
            <textarea class="form-control" id="observacoes" name="observacoes" rows="3">{{ old('observacoes', $procedimento->observacoes) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Salvar <i class="fa-solid fa-floppy-disk"></i></button>
    </form>
</div>
@endsection
