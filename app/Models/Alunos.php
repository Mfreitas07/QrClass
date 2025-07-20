<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    protected $table = 'aluno_cadastrado';

    protected $fillable = [
        'nome_aluno',
        'email',
        'password',
        'turma_id',
        'user_id',
    ];
    public $timestamps = false;

     public function turmas()
    {
        return $this->belongsToMany(TurmaCadastrada::class, 'aluno_turma', 'aluno_id', 'turma_id');
    }
    }
