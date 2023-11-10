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
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('consulta_id')->unique();
            $table->unsignedInteger('procedimento_id');
            $table->text('analise');
            $table->text('diagnostico');
            $table->text('receituario');
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->foreign('consulta_id')->references('id')->on('consultas');
            $table->foreign('procedimento_id')->references('id')->on('procedimentos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atendimentos');
    }
};
