<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialRequerimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_requerimientos', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fechahoraprogramada');
            $table->string('motivo',200);
            
            $table->unsignedBigInteger('detalle_requerimiento_id');
            $table->foreign('detalle_requerimiento_id','fk_historial_requerimiento_detalle')->references('id')->on('detalle_requerimientos');
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
        Schema::dropIfExists('historial_requerimientos');
    }
}
