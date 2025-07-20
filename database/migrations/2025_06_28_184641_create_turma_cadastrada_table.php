<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('turma_cadastrada', function (Blueprint $table) {
            $table->id();
            $table->string('curso');
            $table->string('turma');

            $table->unsignedBigInteger('user_id'); // chave estrangeira para o professor
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('turma_cadastrada');
    }
};
