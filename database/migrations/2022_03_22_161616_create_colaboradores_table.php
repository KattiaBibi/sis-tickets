<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColaboradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colaboradores', function (Blueprint $table) {
            $table->id();
            $table->char('nrodocumento', 8);
            $table->string('nombres',50);
            $table->string('apellidos',50);
            $table->date('fechanacimiento');
            $table->string('direccion', 50)->nullable();
            $table->char('prefijo', 5)->default('51');
            $table->char('telefono', 12)->nullable();
            $table->boolean('estado')->default(1);

            // $table->unsignedBigInteger('empresa_area_id');
            // $table->foreign('empresa_area_id','fk_colaborador_empresa_area')->references('id')->on('empresa_areas');


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
        Schema::dropIfExists('colaboradores');
    }
}
