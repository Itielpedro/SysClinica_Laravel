<!-- funcionarios/show.blade.php -->
@extends('layout')

@section('content')
<div class="container">
    <h1 class="mt-3 mb-3">Detalhes do Funcionário</h1>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ Storage::url($funcionario->foto) }}" class="img-fluid" alt="Foto do Funcionário">
        </div>
        <div class="col-md-6">
            <table class="table table-bordered fs-5">
                <tbody>
                    <tr>
                        <th scope="row">Nome do Funcionário:</th>
                        <td>{{ $funcionario->nome }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Data de Nascimento:</th>
                        <td>{{ date('d/m/Y', strtotime($funcionario->data_nasc)) }}</td>
                    </tr>
                    <tr>
                        <th scope="row">RG:</th>
                        <td>{{ $funcionario->rg }}</td>
                    </tr>
                    <tr>
                        <th scope="row">CPF:</th>
                        <td>{{ $funcionario->cpf }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Rua:</th>
                        <td>{{ $funcionario->rua }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Número:</th>
                        <td>{{ $funcionario->numero }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Bairro:</th>
                        <td>{{ $funcionario->bairro }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Cidade:</th>
                        <td>{{ $funcionario->cidade }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Estado:</th>
                        <td>{{ $funcionario->estado }}</td>
                    </tr>
                    <tr>
                        <th scope="row">CEP:</th>
                        <td>{{ $funcionario->cep }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Telefone:</th>
                        <td>{{ $funcionario->telefone }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email:</th>
                        <td>{{ $funcionario->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Cargo de Funcionário:</th>
                        <td>{{ ucfirst($funcionario->cargo) }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Data de Cadastro:</th>
                        <td>{{ date('d/m/Y', strtotime($funcionario->created_at)) }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('funcionarios.index') }}" class="btn btn-outline-primary mt-3 mb-3 fs-5">Voltar para a lista de funcionários <i class="fa-solid fa-arrow-left"></i></a>
        </div>
    </div>
</div>
@endsection
