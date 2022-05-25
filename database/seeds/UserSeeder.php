<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        User::create([
            'name' => 'Johon',
            'email' => 'johonsalazar@gmail.com',
            'password' => bcrypt('12345678'),
            'colaborador_id' => '1',
            'estado' => '1',
        ])->assignRole('Admin');

        User::create([
            'name' => 'Vanessa',
            'email' => 'vanessa@gmail.com',
            'password' => bcrypt('12345678'),
            'colaborador_id' => '2',
            'estado' => '1',
        ])->assignRole('AdminGerente');


        User::create([
            'name' => 'Janina',
            'email' => 'jrivas@compusistel.com',
            'password' => bcrypt('12345678'),
            'colaborador_id' => '3',
            'estado' => '1',
        ])->assignRole('AdminGerente');


        User::create([
            'name' => 'Kattia',
            'email' => 'bcruzado@compusistel.com',
            'password' => bcrypt('12345678'),
            'colaborador_id' => '4',
            'estado' => '1',
        ])->assignRole('Trabajador');


        User::create([
            'name' => 'David',
            'email' => 'dmanayalle@compusistel.com',
            'password' => bcrypt('12345678'),
            'colaborador_id' => '5',
            'estado' => '1',
        ])->assignRole('Trabajador');


        User::create([
            'name' => 'Maryori',
            'email' => 'mtejada@compusistel.com',
            'password' => bcrypt('12345678'),
            'colaborador_id' => '6',
            'estado' => '1',
        ])->assignRole('Trabajador');


        User::create([
            'name' => 'Juan',
            'email' => 'jdias@compusistel.com',
            'password' => bcrypt('12345678'),
            'colaborador_id' => '7',
            'estado' => '1',
        ])->assignRole('Trabajador');


        User::create([
            'name' => 'Marco',
            'email' => 'marco@gmail.com',
            'password' => bcrypt('12345678'),
            'colaborador_id' => '8',
            'estado' => '1',
        ])->assignRole('Trabajador');


        User::create([
            'name' => 'Cesar',
            'email' => 'cesar@gmail.com',
            'password' => bcrypt('12345678'),
            'colaborador_id' => '9',
            'estado' => '1',
        ])->assignRole('AdminGerente');
    }
}
