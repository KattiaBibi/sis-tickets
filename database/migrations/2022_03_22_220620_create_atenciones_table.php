<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtencionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atenciones', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',200)->nullable();

            $table->unsignedBigInteger('usuarioadmin_id');
            $table->foreign('usuarioadmin_id','fk_atencion_user')->references('id')->on('users');

            $table->unsignedBigInteger('ticket_id');
            $table->foreign('ticket_id','fk_atencion_ticket')->references('id')->on('tickets');

            $table->unsignedBigInteger('servicio_id');
            $table->foreign('servicio_id','fk_atencion_servicio')->references('id')->on('servicios');

            $table->unsignedBigInteger('prioridad_id');
            $table->foreign('prioridad_id','fk_atencion_prioridad')->references('id')->on('prioridades');

            $table->unsignedBigInteger('estado_id')->nullable()->default(3);
            $table->foreign('estado_id','fk_atencion_estado')->references('id')->on('estados')->onDelete('restrict')->onUpdate('restrict');

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
        Schema::dropIfExists('atenciones');
    }
}
