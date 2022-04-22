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
            $table->string('titulo', 50);
            $table->string('descripcion', 250)->nullable();
            $table->dateTime('fecha');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('link_reu', 250)->nullable();
            $table->string('otro_cliente', 50)->nullable();
            $table->string('lugarreu', 250)->nullable();
            $table->enum('tipocita', ['presencial', 'virtual']);
            $table->enum('estado', ['pendiente', 'concluida', 'cancelada']);
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id', 'fk_cita_usuario')->references('id')->on('users');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id', 'fk_cita_empresa')->references('id')->on('empresas');
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
