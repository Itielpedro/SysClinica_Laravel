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
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->time('hora');
            $table->unsignedInteger('paciente_id');
            $table->unsignedInteger('medico_id');
            $table->unsignedInteger('agendamento_id')->unique();
            $table->string('tipo_consulta');
            $table->enum('retorno', ['sim', 'nao']);
            $table->string('status')->default('pendente');
            $table->timestamps();

            $table->foreign('agendamento_id')->references('id')->on('agendamentos')->onDelete('cascade');
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('medico_id')->references('id')->on('medicos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
