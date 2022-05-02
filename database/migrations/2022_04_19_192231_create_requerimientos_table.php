<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequerimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimientos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo',100);

            $table->string('descripcion',600);
            $table->integer('avance');
            $table->enum('prioridad',['alta','media','baja']);
            $table->enum('estado',['pendiente','en espera','en proceso','culminado','cancelado']);
            $table->string('imagen')->nullable();

            $table->unsignedBigInteger('empresa_servicio_id');
            $table->foreign('empresa_servicio_id','fk_empresa_servicios_requerimientos')->references('id')->on('empresa_servicios');

            $table->unsignedBigInteger('usuarioregist_id');
            $table->foreign('usuarioregist_id','fk_requerimientos_usersregist')->references('id')->on('users');

            $table->unsignedBigInteger('usuarioencarg_id');
            $table->foreign('usuarioencarg_id','fk_requerimientos_usersencarg')->references('id')->on('users');
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
        Schema::dropIfExists('requerimientos');
    }
}
