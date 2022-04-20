<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleRequerimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_requerimientos', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('usuario_colab_id');
            $table->foreign('usuario_colab_id','fk_detalle_requerimiento_user')->references('id')->on('users');

            $table->unsignedBigInteger('requerimiento_id');
            $table->foreign('requerimiento_id','fk_detalle_requerimiento_requerimiento')->references('id')->on('requerimientos');

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
        Schema::dropIfExists('detalle_requerimientos');
    }
}
