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
            'id' => '1',
            'nrodocumento' => '77422337',
            'nombres' => 'Kattia',
            'apellidos' => 'Cruzado',
            'fechanacimiento' => '1997/12/14',
            'direccion' => 'Av. Los Quipus 565',
            'telefono' => '979159525',
            'empresa_area_id' => '1',
            'estado' => '1',
        ]);

        Colaborador::create([
            'id' => '2',
            'nrodocumento' => '74500365',
            'nombres' => 'David',
            'apellidos' => 'Manayalle Cachay',
            'fechanacimiento' => '1996/10/30',
            'direccion' => 'Calle Los Laureles #401, San Antonio',
            'telefono' => '991817883',
            'empresa_area_id' => '2',
            'estado' => '1',
        ]);
    }
}
