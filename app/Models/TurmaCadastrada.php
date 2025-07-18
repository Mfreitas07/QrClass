<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TurmaCadastrada extends Model
{
    // Define o nome da tabela correta (no singular)
    protected $table = 'turma_cadastrada';

    protected $fillable = ['curso', 'turma'];

    public function alunos()
    {
        return $this->hasMany(Alunos::class, 'turma_id');
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}