<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlunoTurma extends Model
{
     protected $table = 'aluno_cadastrado';
    protected $fillable = ['nome_aluno', 'email', 'senha'];

    public function turmas()
    {
        return $this->belongsToMany(TurmaCadastrada::class, 'aluno_turma', 'aluno_id', 'turma_id');
    }
}
