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
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->increments("id");
            $table->string('nome');
            $table->date('data_nasc');
            $table->string('rg')->unique();
            $table->string('cpf')->unique();
            $table->string('rua');
            $table->string('numero');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('cep');
            $table->string('estado');
            $table->string('telefone');
            $table->string('email')->unique();
            $table->date('data_admissao');
            $table->date('data_demissao')->nullable();
            $table->enum('cargo', ['admin', 'atendente', 'secretaria', 'medico', 'outros']);
            $table->string('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('funcionarios');
    }
};
