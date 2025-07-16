<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
      protected $table = 'turma_cadastrada';

    protected $fillable = ['curso', 'turma'];

}
