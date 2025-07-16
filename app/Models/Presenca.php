<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presenca extends Model
{
    protected $fillable = ['aluno_id', 'chamada_id', 'horario'];

    protected $casts = [
        'horario' => 'datetime',
    ];

    public function aluno() {
        return $this->belongsTo(Alunos::class, 'aluno_id');
    }

    public function chamada() {
        return $this->belongsTo(Chamada::class, 'chamada_id');
    }
}
