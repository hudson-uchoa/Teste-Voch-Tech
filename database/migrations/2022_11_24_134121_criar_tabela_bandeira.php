<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaBandeira extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bandeira', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gec_id')->constrained('grupo_economico')->onDelete('cascade')->onUpdate('cascade');
            $table->string('ban_nome', 250);
            $table->string('ban_documento', 14)->nullable();
            $table->boolean('ban_ativo')->default(1);
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
        Schema::dropIfExists('bandeira');
    }
}
