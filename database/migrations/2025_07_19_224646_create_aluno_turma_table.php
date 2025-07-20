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
       Schema::create('aluno_turma', function (Blueprint $table) {
    $table->id();
    $table->foreignId('aluno_id')->constrained('aluno_cadastrado')->onDelete('cascade');
    $table->foreignId('turma_id')->constrained('turma_cadastrada')->onDelete('cascade');
    $table->timestamps();

    $table->unique(['aluno_id', 'turma_id']); // Garante que não se repita
});

    }
    public function down(): void
    {
        Schema::dropIfExists('aluno_turma');
    }
};
