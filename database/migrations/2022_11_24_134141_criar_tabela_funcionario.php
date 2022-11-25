<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaFuncionario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gec_id')->constrained('grupo_economico')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ban_id')->constrained('bandeira')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('uni_id')->constrained('unidade')->onDelete('cascade')->onUpdate('cascade');
            $table->string('fun_nome', 250);
            $table->string('fun_documento', 14);
            $table->string('fun_celular')->nullable();
            $table->boolean('fun_ativo')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionario');
    }
}
