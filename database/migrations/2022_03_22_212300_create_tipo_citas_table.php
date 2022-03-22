<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_citas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',50);

            $table->unsignedBigInteger('estado_id')->nullable()->default(1);
            $table->foreign('estado_id','fk_tipo_cita_estado')->references('id')->on('estados')->onDelete('restrict')->onUpdate('restrict');

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
        Schema::dropIfExists('tipo_citas');
    }
}
