<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'data_nasc',
        'rg',
        'cpf',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'cep',
        'estado',
        'telefone',
        'email',
        'foto',
        'info_medica',
    ];
}
