<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aluno_cadastrado', function (Blueprint $table) {
            $table->id(); // Chave primária do aluno

            $table->string('nome_aluno');
            $table->string('email')->unique();

            // Senha em texto simples, conforme solicitado
            $table->string('password');

            // Chave estrangeira para a turma
            $table->unsignedBigInteger('turma_id');

            $table->timestamps();

            // Definição da chave estrangeira
            $table->foreign('turma_id')
                  ->references('id')
                  ->on('turma_cadastrada')
                  ->onDelete('cascade'); // Deleta alunos ao deletar a turma
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aluno_cadastrado');
    }
};