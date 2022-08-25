<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequerimientoRespuestasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimiento_respuestas', function (Blueprint $table) {
            $table->id();
            $table->string('ruta_recurso', 255);
            $table->string('descripcion', 1000)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('requerimiento_id');
            $table->foreign('requerimiento_id')->references('id')->on('requerimientos');
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
        Schema::dropIfExists('requerimiento_respuestas');
    }
}
