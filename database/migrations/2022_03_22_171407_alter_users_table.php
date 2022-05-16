<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::table('users', function (Blueprint $table) {

            $table->unsignedBigInteger('colaborador_id')->after('password');
            $table->foreign('colaborador_id','fk_user_colaborador')->references('id')->on('colaboradores');
            $table->boolean('estado')->default(1)->after('colaborador_id');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()

        //
        {
            Schema::dropIfExists('users');
        }

}
