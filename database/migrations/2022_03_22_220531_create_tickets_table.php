<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('problema',200);
            $table->string('detalle',600);
            $table->unsignedBigInteger('empresa_servicio_id');
            $table->foreign('empresa_servicio_id','fk_ticket_empresa_servicio')->references('id')->on('empresa_servicios');

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id','fk_ticket_user')->references('id')->on('users');

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
        Schema::dropIfExists('tickets');
    }
}
