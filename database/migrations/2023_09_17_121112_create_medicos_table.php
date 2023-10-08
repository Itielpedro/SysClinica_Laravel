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
        Schema::create('medicos', function (Blueprint $table) {
            $table->increments("id");
            $table->string('nome');
            $table->date('data_nasc');
            $table->string('rg')->unique();
            $table->string('cpf')->unique();
            $table->string('crm')->unique();
            $table->string('rua');
            $table->string('numero');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('cep');
            $table->string('estado');
            $table->string('telefone');
            $table->string('email')->unique();
            $table->string('foto');
            $table->unsignedInteger('especialidade_id');
            $table->foreign('especialidade_id')->references('id')->on('especialidades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
