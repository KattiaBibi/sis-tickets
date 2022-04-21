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
    }
}
