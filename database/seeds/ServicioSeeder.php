<?php

use Illuminate\Database\Seeder;
use App\Servicio;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Servicio::create([
            'id' => '1',
            'nombre' => 'SOPORTE',
            'estado' => '1',
        ]);

    }
}
