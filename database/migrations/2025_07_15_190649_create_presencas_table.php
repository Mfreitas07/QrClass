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
        Schema::create('presencas', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('chamada_id');
            $table->timestamp('horario')->default(now()); // Quando marcou presença

            $table->timestamps();

            // 🔗 Chaves estrangeiras
            $table->foreign('aluno_id')->references('id')->on('aluno_cadastrado')->onDelete('cascade');
            $table->foreign('chamada_id')->references('id')->on('chamadas')->onDelete('cascade');

            // 🛡️ Evita que o mesmo aluno registre presença duas vezes na mesma chamada
            $table->unique(['aluno_id', 'chamada_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presencas');
    }
};
