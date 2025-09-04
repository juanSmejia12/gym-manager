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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre del equipo
            $table->text('description')->nullable(); // Descripción opcional
            $table->unsignedInteger('quantity')->default(1); // Cantidad disponible
            $table->decimal('weight', 5, 2)->nullable(); // Peso (Kg), opcional
            $table->boolean('condition')->default(true); // Estado: disponible (true) o no disponible (false)
            $table->foreignId('type_id')->constrained()->onDelete('cascade'); // Tipo de equipo (mancuernas, maquinas, etc.)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
