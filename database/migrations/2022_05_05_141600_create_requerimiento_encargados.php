<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequerimientoEncargados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requerimiento_encargados', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('requerimiento_id');
            $table->foreign('requerimiento_id','fk_requerimiento_encargado:requerimiento')->references('id')->on('requerimientos');

            $table->unsignedBigInteger('usuarioencarg_id');
            $table->foreign('usuarioencarg_id','fk_requerimientos_usersencarg')->references('id')->on('users');

            // $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requerimiento_encargados');
    }
}
