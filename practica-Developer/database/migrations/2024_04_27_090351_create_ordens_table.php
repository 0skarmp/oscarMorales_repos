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
        Schema::create('ordens', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->unsignedBigInteger('fk_paciente');
            $table->foreign('fk_paciente')->references('id')->on('pacientes')->onDelete('cascade');
            $table->unsignedBigInteger('fk_medico')->nullable();
            $table->foreign('fk_medico')->references('id')->on('medicos')->onDelete('set null');
            $table->decimal('precio_total', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordens');
    }
};
