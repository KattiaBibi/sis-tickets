<?php

use App\Servicio;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servicio::create([
            'id' => '1',
            'nombre' => 'SOPORTE',
            'estado' => '1',
        ]);
    }
}
