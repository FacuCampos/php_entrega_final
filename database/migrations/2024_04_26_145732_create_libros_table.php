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
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('usuario', 40);
            $table->string('titulo', 100)->nullable();
            $table->string('autor', 40)->nullable();
            $table->string('publicacion', 20)->nullable();
            $table->string('genero', 25)->nullable();
            $table->text('descripcion')->nullable();
            $table->string('portada', 100)->nullable();
            $table->boolean('finalizado')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
