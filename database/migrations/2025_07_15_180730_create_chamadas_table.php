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
        Schema::create('chamadas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique(); // Código único (UUID para o QR Code)
            $table->unsignedBigInteger('turma_id');
            $table->timestamp('data_aula')->default(now());
            $table->timestamps();

            $table->foreign('turma_id')
                  ->references('id')
                  ->on('turma_cadastrada')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamadas');
    }
};
