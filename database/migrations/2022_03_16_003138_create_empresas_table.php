<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('ruc',11);
            $table->string('nombre', 50);
            $table->text('direccion', 150);
            $table->text('telefono', 12);
            $table->unsignedBigInteger('estado_id')->nullable()->default(1);
            $table->foreign('estado_id','fk_empresa_estado')->references('id')->on('estados')->onDelete('restrict')->onUpdate('restrict');

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
        Schema::dropIfExists('empresas');
    }

}
