@extends('layout')
@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/0.9.0/jquery.mask.min.js" integrity="sha512-oJCa6FS2+zO3EitUSj+xeiEN9UTr+AjqlBZO58OPadb2RfqwxHpjTU8ckIC8F4nKvom7iru2s8Jwdo+Z8zm0Vg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $("#cpf").mask("000.000.000-00");
        $("#telefone").mask("(00)00000-0000");
        $("#cep").mask("00000-000");
    });
</script>

@endsection

@section('content')
<div class="container col-6">
    <h1 class="mt-3 mb-3">Cadastrar Paciente</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form method="POST" action="{{ route('pacientes.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">


            <div class="form-group mb-2">
                <label for="nome">Nome do Paciente</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label for="data_nasc">Data de Nascimento</label>
                <input type="date" name="data_nasc" id="data_nasc" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label for="rg">RG</label>
                <input type="text" name="rg" id="rg" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" id="cpf" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label for="rua">Rua</label>
                <input type="text" name="rua" id="rua" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label for="numero">Número</label>
                <input type="text" name="numero" id="numero" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label for="bairro">Bairro</label>
                <input type="text" name="bairro" id="bairro" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label for="cidade">Cidade</label>
                <input type="text" name="cidade" id="cidade" class="form-control" required>
            </div>
            <div class="form-group mb-2">
                <label for="estado">Estado</label>
                <select class="form-control" id="estado" name="estado">
                    @foreach ($estados as $sigla => $nome)
                    <option value="{{ $sigla }}">{{ $nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="cep">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" required>
            </div>
            <div class="form-group mb-2">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control" required>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="info_medica">Informações Médicas</label>
                <textarea class="form-control" id="info_medica" name="info_medica" rows="5" placeholder="Digite as informações médicas do paciente"></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control-file" required accept="image/*">
            </div>
            <button type="submit" class="btn btn-success mb-2">Salvar <i class="fa-solid fa-floppy-disk"></i></button>
        </div>
    </form>
</div>
@endsection
