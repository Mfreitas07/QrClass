<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurmaCadastrada extends Model
{
    protected $table = 'turma_cadastrada';

    protected $fillable = ['curso', 'turma', 'user_id']; // Adicione user_id se ainda não estiver

   public function alunos()
{
    return $this->belongsToMany(Alunos::class, 'aluno_turma', 'turma_id', 'aluno_id');
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}