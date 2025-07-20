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
    Schema::create('links_plataforma', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('professor_id'); // opcional: vincular ao professor
        $table->string('link');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links_plataforma');
    }
};
