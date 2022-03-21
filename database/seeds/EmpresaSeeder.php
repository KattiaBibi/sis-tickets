<?php

use Illuminate\Database\Seeder;
use App\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Empresa::create([
            'id'=>'1',
            'nombre'=>'COMPUSISTEL',
            'direccion'=>'EJEMPLO',
            'telefono'=>'45334534',
            'estado_id'=>'1',

        ]);

    }
}
