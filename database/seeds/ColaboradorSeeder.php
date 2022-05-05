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
            'apellidos' => 'Manayalle',
            'fechanacimiento' => '1996/10/30',
            'direccion' => 'Calle Los Laureles #401, San Antonio',
            'telefono' => '991817883',
            'empresa_area_id' => '2',
            'estado' => '1',
        ]);


        Colaborador::create([
            'id' => '3',
            'nrodocumento' => '44123654',
            'nombres' => 'Vanessa',
            'apellidos' => 'Burga',
            'fechanacimiento' => '1996/11/02',
            'direccion' => 'Calle Saucedo 354',
            'telefono' => '995092706',
            'empresa_area_id' => '5',
            'estado' => '1',
        ]);

        Colaborador::create([
            'id' => '4',
            'nrodocumento' => '69696958',
            'nombres' => 'Marco',
            'apellidos' => 'Gálvez',
            'fechanacimiento' => '1992/02/21',
            'direccion' => 'Av. Los Andes 424',
            'telefono' => '979652303',
            'empresa_area_id' => '7',
            'estado' => '1',
        ]);



        Colaborador::create([
            'id' => '5',
            'nrodocumento' => '74123589',
            'nombres' => 'Test',
            'apellidos' => 'test 2',
            'fechanacimiento' => '1993/01/21',
            'direccion' => 'Av. Murillo 424',
            'telefono' => '789562310',
            'empresa_area_id' => '5',
            'estado' => '1',
        ]);
    }
}
