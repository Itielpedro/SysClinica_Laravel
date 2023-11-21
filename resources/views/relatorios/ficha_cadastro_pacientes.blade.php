<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de Cadastro do Paciente</title>
    <link rel="shortcut icon" href="{{ asset('images/logo-med.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    

    <table border="1" cellspacing="5" cellpadding="0">


<h3 style="text-align:center;">INFORMAÇÕES PESSOAIS</h3>

<tr style="background-color:green;color:white;">
    <th >NOME</th>
    <td> $paciente->nome</td>
</tr>
<tr style="background-color:green;color:white;">
    <th>CPF</th>
    <td>$paciente->cpf</td>
</tr>
<tr style="background-color:green;color:white;">
    <th>RG</th>
    <td>$paciente->rg</td>
</tr>
<tr style="background-color:green;color:white;">
    <th>Data de Nascimento</th>
    <td> $data</td>
</tr>

<h3 style="text-align:center;">ENDEREÇO</h3>

<tr>
    <th>RUA</th>
    <td>$paciente->rua</td>
</tr>
<tr>
    <th>NUMÉRO</th>
    <td>$paciente->numero</td>
</tr>
<tr>
    <th>BAIRRO</th>
    <td>$paciente->bairro</td>
</tr>
<tr>
    <th>CIDADE</th>
    <td> $paciente->cidade</td>
</tr>

<h3 style="text-align:center;">CONTATO</h3>

<tr>
    <th>TELEFONE</th>
    <td> $paciente->telefone</td>
</tr>
<tr>
    <th>EMAIL</th>
    <td>$paciente->email </td>
</tr>



</table>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
