<?php

use Illuminate\Database\Seeder;
use App\Estado;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Estado::create([
            'id'=>'1',
            'nombre'=>'ACTIVO',
        ]);

        Estado::create([
            'id'=>'2',
            'nombre'=>'INACTIVO',
        ]);
    }
}