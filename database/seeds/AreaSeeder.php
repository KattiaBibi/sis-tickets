<?php

use Illuminate\Database\Seeder;
use App\Area;

class AreaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Area::create([
      'id' => '1',
      'nombre' => 'GERENTE GENERAL',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '2',
      'nombre' => 'GERENTE GENERAL',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '3',
      'nombre' => 'GERENTE GENERAL',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '4',
      'nombre' => 'GERENTE GENERAL',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '5',
      'nombre' => 'GERENTE GENERAL',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '6',
      'nombre' => 'GERENTE GENERAL',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '7',
      'nombre' => 'GERENTE GENERAL',
      'estado' => '1'
    ]);
  }
}
