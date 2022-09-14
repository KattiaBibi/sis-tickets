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
    // JM DESARROLLADOR
    User::create([
      'name' => 'gerencia',
      'email' => 'gerencia@jmdesarrollador.com',
      'password' => bcrypt('123456789'),
      'colaborador_id' => '1',
      'estado' => '1',
    ])->assignRole('Admin');
  }
}
