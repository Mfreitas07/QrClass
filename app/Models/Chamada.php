<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamada extends Model
{
    protected $fillable = ['codigo', 'turma_id', 'data_aula', 'user_id'];

    protected $casts = [
        'data_aula' => 'datetime',
    ];

    public function turma() {
        return $this->belongsTo(TurmaCadastrada::class, 'turma_id');
    }

    public function presencas() {
        return $this->hasMany(Presenca::class);
    }
}
