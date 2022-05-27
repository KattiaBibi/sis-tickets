      <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_citas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('cita_id');
            $table->foreign('cita_id','fk_detalle_cita_cita')->references('id')->on('citas');

            $table->unsignedBigInteger('usuario_colab_id');
            $table->foreign('usuario_colab_id','fk_detalle_cita_user')->references('id')->on('colaboradores');

            $table->tinyInteger('confirmation')->default(0);
            $table->dateTime('confirmation_at')->nullable();

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
        Schema::dropIfExists('detalle_citas');
    }
}
