<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('turma_cadastrada', function (Blueprint $table) {
            $table->id(); // Cria a coluna 'id' como chave primária
            $table->string('curso');
            $table->string('turma');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('turma_cadastrada');
    }
};
