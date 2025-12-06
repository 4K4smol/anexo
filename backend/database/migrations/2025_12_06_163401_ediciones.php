<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('ediciones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('obra_id')->constrained('obras')->onDelete('cascade');
            $table->foreignId('editorial_id')->nullable()->constrained('editoriales')->onDelete('set null');
            $table->foreignId('coleccion_id')->nullable()->constrained('colecciones')->onDelete('set null');

            $table->string('isbn')->nullable();
            $table->string('traductor')->nullable();
            $table->year('anio')->nullable();
            $table->integer('paginas')->nullable();
            $table->string('numero_edicion')->nullable(); // “1ª edición”, “2ª revisada”, etc.

            // Datos externos
            $table->string('fuente_externa')->nullable();
            $table->string('id_externo')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
