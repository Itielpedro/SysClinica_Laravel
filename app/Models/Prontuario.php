<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prontuario extends Model
{
    use HasFactory;
    protected $fillable = ['paciente_id'];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'paciente_id', 'paciente_id');
    }

}
