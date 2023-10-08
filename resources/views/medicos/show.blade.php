
@extends('layout')

@section('content')
<div class="container">
    <h1 class="mt-3 mb-3">Detalhes do Médico</h1>
    <div class="row">
        <div class="col-md-6">
            <img src="{{ Storage::url($medico->foto) }}" class="img-fluid" alt="Foto do Médico">
        </div>
        <div class="col-md-6">
            <table class="table table-bordered fs-5">
                <tbody>
                    <tr>
                        <th scope="row">Nome do Médico:</th>
                        <td>{{ $medico->nome }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Data de Nascimento:</th>
                        <td>{{ date('d/m/Y', strtotime($medico->data_nasc)) }}</td>
                    </tr>
                    <tr>
                        <th scope="row">RG:</th>
                        <td>{{ $medico->rg }}</td>
                    </tr>
                    <tr>
                        <th scope="row">CPF:</th>
                        <td>{{ $medico->cpf }}</td>
                    </tr>
                    <tr>
                        <th scope="row">CRM:</th>
                        <td>{{ $medico->crm }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Rua:</th>
                        <td>{{ $medico->rua }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Número:</th>
                        <td>{{ $medico->numero }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Bairro:</th>
                        <td>{{ $medico->bairro }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Cidade:</th>
                        <td>{{ $medico->cidade }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Estado:</th>
                        <td>{{ $medico->estado }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Cep:</th>
                        <td>{{ $medico->cep }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Telefone:</th>
                        <td>{{ $medico->telefone }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Email:</th>
                        <td>{{ $medico->email }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Especialidade:</th>
                        <td>{{ $medico->especialidade->nome }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Data de Cadastro</th>
                        <td>{{ date('d/m/Y', strtotime($medico->created_at)) }}</td>
                    </tr>
                </tbody>
            </table>
            <a href="{{ route('medicos.index') }}" class="btn btn-outline-primary mt-3 mb-3 fs-5">Voltar para a lista de médicos <i class="fa-solid fa-arrow-left"></i></a>
        </div>
    </div>
</div>
@endsection
