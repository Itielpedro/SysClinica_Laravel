@extends('layout')

@section('content')
<div class="container">
    <h1 class="mt-3 mb-3">Adicionar Procedimento</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('procedimentos.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <input type="text" class="form-control" id="descricao" name="descricao" value="{{ old('descricao') }}" required>
        </div>
        <div class="form-group">
            <label for="valor">Valor:</label>
            <input type="number" class="form-control" id="valor" name="valor" value="{{ old('valor') }}" required>
        </div>
        <div class="form-group">
            <label for="observacoes">Observações:</label>
            <textarea class="form-control" id="observacoes" name="observacoes">{{ old('observacoes') }}</textarea>
        </div>
        <button type="submit" class="btn btn-outline-success">Salvar <i class="fa-solid fa-floppy-disk"></i></button>

    </form>
</div>
@endsection
