<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    use HasFactory;

    protected $fillable = [
        'consulta_id',
        'procedimento_id',
        'analise',
        'diagnostico',
       'receituario',
       'status',
    ];

    public function procedimento()
    {
        return $this->belongsTo(Procedimento::class);
    }
}
