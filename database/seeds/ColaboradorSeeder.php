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
            'nrodocumento' => '42023698',
            'nombres' => 'Johon',
            'apellidos' => 'Salazar Baigorria',
            'fechanacimiento' => '1980/12/14',
            'direccion' => 'Test 1',
            'telefono' => '979159525',
            'empresa_area_id' => '1',
            'estado' => '1',
        ]);

        Colaborador::create([
            'nrodocumento' => '74123658',
            'nombres' => 'Vanessa',
            'apellidos' => 'Burga',
            'fechanacimiento' => '1996/02/21',
            'direccion' => 'Test 2',
            'telefono' => '966877868',
            'empresa_area_id' => '5',
            'estado' => '1',
        ]);
        Colaborador::create([
            'nrodocumento' => '98520369',
            'nombres' => 'Janina Maricruz',
            'apellidos' => 'Rivas Cabrejos',
            'fechanacimiento' => '1995/12/16',
            'direccion' => 'Test 3',
            'telefono' => '914845466',
            'empresa_area_id' => '1',
            'estado' => '1',
        ]);

        Colaborador::create([
            'nrodocumento' => '77422337',
            'nombres' => 'Kattia Bibiana',
            'apellidos' => 'Cruzado Chávez',
            'fechanacimiento' => '1997/12/14',
            'direccion' => 'Calle Los Quipus 565',
            'telefono' => '995092702',
            'empresa_area_id' => '2',
            'estado' => '1',
        ]);

        Colaborador::create([
            'nrodocumento' => '74500365',
            'nombres' => 'David',
            'apellidos' => 'Manayalle Cachay',
            'fechanacimiento' => '1996/10/30',
            'direccion' => 'Calle Los Laureles #401, San Antonio',
            'telefono' => '991817883',
            'empresa_area_id' => '2',
            'estado' => '1',
        ]);

        Colaborador::create([
            'nrodocumento' => '73968019',
            'nombres' => 'Maryori Yaslitd',
            'apellidos' => 'Tejada Isuiza',
            'fechanacimiento' => '1997/02/28',
            'direccion' => 'Mz. Ll. Lt. 16 Las Delicias',
            'telefono' => '970854239',
            'empresa_area_id' => '8',
            'estado' => '1',
        ]);


        Colaborador::create([
            'nrodocumento' => '71593306',
            'nombres' => 'Juan Miguel',
            'apellidos' => 'Díaz Hernández',
            'fechanacimiento' => '1992/03/16',
            'direccion' => 'Calle Napo 169 Urb. Quiñonez',
            'telefono' => '990448430',
            'empresa_area_id' => '2',
            'estado' => '1',
        ]);

        Colaborador::create([
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
            'nrodocumento' => '74230658',
            'nombres' => 'César',
            'apellidos' => 'Test',
            'fechanacimiento' => '1990/02/21',
            'direccion' => 'Test',
            'telefono' => '979652303',
            'empresa_area_id' => '5',
            'estado' => '1',
        ]);



    }
}
