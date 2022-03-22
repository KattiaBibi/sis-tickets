<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo',50);
            $table->string('descripcion', 250);
            $table->dateTime('fecha_hora_inicio');
            $table->dateTime('fecha_hora_fin');
            $table->string('link_zoom',150);

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id','fk_cita_usuario')->references('id')->on('users');

            $table->unsignedBigInteger('tipo_cita_id');
            $table->foreign('tipo_cita_id','fk_cita_tipo_cita')->references('id')->on('tipo_citas');

            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id','fk_cita_empresa')->references('id')->on('empresas');

            $table->unsignedBigInteger('estado_id')->nullable()->default(1);
            $table->foreign('estado_id','fk_cita_estado')->references('id')->on('estados')->onDelete('restrict')->onUpdate('restrict');

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
        Schema::dropIfExists('citas');
    }
}
