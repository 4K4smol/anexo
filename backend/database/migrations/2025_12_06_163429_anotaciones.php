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
        Schema::create('anotaciones', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('obra_id')->constrained('obras')->onDelete('cascade');
            $table->foreignId('edicion_id')->constrained('ediciones')->onDelete('cascade');

            $table->enum('tipo', ['cita', 'idea', 'concepto', 'resumen']);

            $table->text('contenido');     // Idea o comentario personal
            $table->text('cita')->nullable(); // Cita literal del libro

            $table->integer('pagina_inicio')->nullable();
            $table->integer('pagina_fin')->nullable();

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
