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
        Schema::create('atenciones', function (Blueprint $table) {
            $table->id();
            $table->string('semestre', 20);
            $table->date('fecha');
            $table->time('hora');
            $table->foreignId('docente_id')->constrained()->onDelete('cascade');
            $table->foreignId('estudiante_id')->constrained()->onDelete('cascade');
            $table->foreignId('tema_id')->constrained()->onDelete('cascade');
            $table->text('consulta');
            $table->text('descripcion');
            $table->string('evidencia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atenciones');
    }
};
