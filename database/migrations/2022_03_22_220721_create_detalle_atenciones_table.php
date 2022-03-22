<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleAtencionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_atenciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_colab_id');
            $table->foreign('usuario_colab_id','fk_detalle_atencion_user')->references('id')->on('users');

            $table->unsignedBigInteger('atencion_id');
            $table->foreign('atencion_id','fk_detalle_atencion_atencion')->references('id')->on('atenciones');

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
        Schema::dropIfExists('detalle_atenciones');
    }
}
