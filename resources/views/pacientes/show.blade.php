<!-- medicos/show.blade.php -->
@extends('layout')

@section('content')
<div class="container">
    <h1 class="mt-3 mb-3">Detalhes do Paciente</h1>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ Storage::url($paciente->foto) }}" class="img-fluid" alt="Foto do Médico">
        </div>
        <div class="col-md-6">
            <table class="table table-bordered fs-5">
                <tbody>
                    <tr>
                        <th scope="row">Nome do Paciente:</th>
                        <td>{{ $paciente->nome }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Data de Nascimento:</th>
                        <td>{{ date('d/m/Y', strtotime($paciente->data_nasc)) }}</td>
                    </tr>
                    <tr>
                        <th scope="row">RG:</th>
                        <td>{{ $paciente->rg }}</td>
                    </tr>
                    <tr>
                        <th scope="row">CPF:</th>
                        <td>{{ $paciente->cpf }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Rua:</th>
                        <td>{{ $paciente->rua }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Número:</th>
                        <td>{{ $paciente->numero }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Bairro:</th>
                        <td>{{ $paciente->bairro }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Cidade:</th>
                        <td>{{ $paciente->cidade }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Estado:</th>
                        <td>{{ $paciente->estado }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Cep:</th>
                        <td>{{ $paciente->cep }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Telefone:</th>
                        <td>{{ $paciente->telefone }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email:</th>
                        <td>{{ $paciente->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Informações Médicas</th>
                        <td>{{ $paciente->info_medica }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Data de Cadastro</th>
                        <td>{{ date('d/m/Y', strtotime($paciente->created_at)) }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('pacientes.index') }}" class="btn btn-outline-primary mt-3 mb-3 fs-5">Voltar para a lista de pacientes <i class="fa-solid fa-arrow-left"></i></a>
        </div>
    </div>
</div>
@endsection
