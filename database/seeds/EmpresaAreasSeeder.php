<?php

use Illuminate\Database\Seeder;
use App\EmpresaArea;

class EmpresaAreasSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    EmpresaArea::create([
      'id' => '1',
      'empresa_id' => '1',
      'area_id' => '1',
    ]);

    EmpresaArea::create([
      'id' => '2',
      'empresa_id' => '2',
      'area_id' => '2',
    ]);

    EmpresaArea::create([
      'id' => '3',
      'empresa_id' => '3',
      'area_id' => '3',
    ]);

    EmpresaArea::create([
      'id' => '4',
      'empresa_id' => '4',
      'area_id' => '4',
    ]);

    EmpresaArea::create([
      'id' => '5',
      'empresa_id' => '5',
      'area_id' => '5',
    ]);

    EmpresaArea::create([
      'id' => '6',
      'empresa_id' => '6',
      'area_id' => '6',
    ]);

    EmpresaArea::create([
      'id' => '7',
      'empresa_id' => '7',
      'area_id' => '7',
    ]);
  }
}
