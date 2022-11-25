<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaGrupoEconomico extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_economico', function (Blueprint $table) {
            $table->id();
            $table->string('gec_razao_social', 250);
            $table->string('gec_nome_fantasia', 250);
            $table->string('gec_documento', 14);
            $table->boolean('gec_ativo')->default(1);
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
        Schema::dropIfExists('grupo_economico');
    }
}
