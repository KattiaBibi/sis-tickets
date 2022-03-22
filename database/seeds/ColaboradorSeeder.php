<?php

use Illuminate\Database\Seeder;
use App\Colaborador;

class ColaboradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Colaborador::create([
            'id'=>'1',
            'nrodocumento'=>'77422337',
            'nombres'=>'Kattia',
            'apellidos'=>'Cruzado',
            'fechanacimiento'=>'1997/12/14',
            'direccion'=>'Av. Los Quipus 565',
            'telefono'=>'979159525',
            'empresa_area_id'=>'1',
            'estado_id' =>'1',

        ]);
    }
}
