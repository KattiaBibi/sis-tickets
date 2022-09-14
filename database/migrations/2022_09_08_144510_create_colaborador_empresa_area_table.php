<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColaboradorEmpresaAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colaborador_empresa_area', function (Blueprint $table) {
            $table->id();
            $table->string('correo_corporativo', 255);
            $table->foreign('colaborador_id')->references('id')->on('colaboradores');
            $table->unsignedBigInteger('colaborador_id');
            $table->foreign('empresa_area_id')->references('id')->on('empresa_areas');
            $table->unsignedBigInteger('empresa_area_id');
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
        Schema::dropIfExists('colaborador_empresa_area');
    }
}
