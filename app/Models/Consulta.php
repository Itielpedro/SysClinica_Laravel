<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'hora',
        'paciente_id',
        'medico_id',
        'tipo_consulta',
        'retorno',
        'agendamento_id'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico_id');
    }

    public function agendamento()
    {
        return $this->belongsTo(Agendamento::class);
    }

    public function prontuario()
    {
        return $this->belongsTo(Prontuario::class);
    }

    public function atendimentos()
    {
        return $this->hasMany(Atendimento::class);
    }

}
