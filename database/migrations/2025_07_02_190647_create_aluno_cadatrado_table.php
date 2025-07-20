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
            $table->string('password'); // Armazenada como texto simples por enquanto

            // Relacionamento com a turma
            $table->unsignedBigInteger('turma_id');
            $table->foreign('turma_id')
                  ->references('id')
                  ->on('turma_cadastrada')
                  ->onDelete('cascade');

            // Relacionamento com o professor (usuário)
            $table->unsignedBigInteger('user_id'); // Novo campo
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            $table->timestamps();
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
