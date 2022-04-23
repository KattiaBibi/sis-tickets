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
            'name' => 'Kattia',
            'email' => 'kattia1997-@hotmail.com',
            'password' => bcrypt('12345678'),
            'colaborador_id' => '1',
        ])->assignRole('Admin');

        User::create([
            'name' => 'David',
            'email' => 'elbooz30@hotmail.com',
            'password' => bcrypt('87654321'),
            'colaborador_id' => '2',
        ])->assignRole('Trabajador');


        User::create([
            'name' => 'Vanessa',
            'email' => 'vanessa@gmail.com',
            'password' => bcrypt('12345678'),
            'colaborador_id' => '3',
        ])->assignRole('Admin');

        User::create([
            'name' => 'Marco',
            'email' => 'marco@gmail.com',
            'password' => bcrypt('12345678'),
            'colaborador_id' => '4',
        ])->assignRole('Trabajador');


    }
}
