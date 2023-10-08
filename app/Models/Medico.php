<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'data_nasc',
        'rg',
        'cpf',
        'crm',
        'rua',
        'numero',
        'bairro',
        'cidade',
        'cep',
        'estado',
        'telefone',
        'email',
        'foto',
        'especialidade_id',
    ];

    public function especialidade()
{
    return $this->belongsTo(Especialidade::class, 'especialidade_id');
}
}
