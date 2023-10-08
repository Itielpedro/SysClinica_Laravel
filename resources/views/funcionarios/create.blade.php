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
<div class="container col-md-8">
    <h1 class="mt-3 mb-3">Cadastrar Funcionário</h1>
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <form action="{{ route('funcionarios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nome_completo">Nome Completo</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="form-group">
            <label for="data_nascimento">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nasc" name="data_nasc" required>
        </div>

        <div class="form-group">
            <label for="rg">RG</label>
            <input type="text" class="form-control" id="rg" name="rg" required>
        </div>

        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" required>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="rua">Rua</label>
                <input type="text" class="form-control" id="rua" name="rua" required>
            </div>
            <div class="form-group col-md-2">
                <label for="numero">Número</label>
                <input type="text" class="form-control" id="numero" name="numero" required>
            </div>
            <div class="form-group col-md-4">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" required>
            </div>
            <div class="form-group col-md-4">
                <label for="estado">Estado</label>
                <select class="form-control" id="estado" name="estado">
                    @foreach ($estados as $sigla => $nome)
                    <option value="{{ $sigla }}">{{ $nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-2">
                <label for="cep">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" required>
            </div>

            <div class="form-group col-md-4">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" required>
            </div>

            <div class="form-group col-md-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>


            <div class="form-group col-md-4">
                <label for="cargo">Cargo do Funcionário</label>
                <select class="form-control" id="cargo" name="cargo" required>
                    <option value="admin">Admin</option>
                    <option value="atendente">Atendente</option>
                    <option value="secretaria">Secretária</option>
                    <option value="medico">Médico</option>
                    <option value="outros">Outros</option>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label for="data_admissao">Data de Admissão</label>
                <input type="date" class="form-control" id="data_admissao" name="data_admissao" required>
            </div>

            <div class="form-group col-md-6">
                <label for="data_demissao">Data de Demissão</label>
                <input type="date" class="form-control" id="data_demissao" name="data_demissao">
            </div>


            <div class="form-group col-md-12">
                <label for="foto">Foto</label>
                <input type="file" class="form-control-file" id="foto" name="foto">
            </div>

            <button type="submit" class="btn btn-outline-success mb-3 col-md-12">Cadastrar Funcionário <i class="fa-solid fa-floppy-disk"></i></button>
    </form>
</div>
@endsection
