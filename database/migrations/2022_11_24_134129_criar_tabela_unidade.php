<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaUnidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidade', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gec_id')->constrained('grupo_economico')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('ban_id')->constrained('bandeira')->onDelete('cascade')->onUpdate('cascade');
            $table->string('uni_razao_social', 250);
            $table->string('uni_nome_fantasia', 250);
            $table->string('uni_documento', 14);
            $table->boolean('uni_ativo')->default(1);
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
        Schema::dropIfExists('unidade');
    }
}
