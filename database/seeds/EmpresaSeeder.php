<?php

use Illuminate\Database\Seeder;
use App\Empresa;

class EmpresaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Empresa::create([
      'id' => '1',
      'ruc' => '98756320125',
      'nombre' => 'JM DESARROLLADOR',
      'direccion' => 'CALLE ARIZOLA #130 - B',
      'telefono' => '123789',
      'color' => '#082338'
    ]);

    Empresa::create([
      'id' => '2',
      'ruc' => '96306520369',
      'nombre' => 'N LEÓN',
      'direccion' => 'AV. TEST #213',
      'telefono' => '123789',
      'color' => '#cceb34'
    ]);

    Empresa::create([
      'id' => '3',
      'ruc' => '78423233232',
      'nombre' => 'GENEXIDU',
      'direccion' => 'CALLE ARIZOLA #130 - B',
      'telefono' => '123789',
      'color' => '#00e0ba'
    ]);

    Empresa::create([
      'id' => '4',
      'ruc' => '90365202158',
      'nombre' => 'JM INMOBILIARIAS',
      'direccion' => 'AV. TEST #123',
      'telefono' => '123789',
      'color' => '#C42929'
    ]);

    Empresa::create([
      'id' => '5',
      'ruc' => '10408842889',
      'nombre' => 'COMPUSISTEL',
      'direccion' => 'AV. SANTA VICTORIA #452',
      'telefono' => '123456',
      'color' => '#0000ff'
    ]);

    Empresa::create([
      'id' => '6',
      'ruc' => '12546454564',
      'nombre' => 'JM HOLDING',
      'direccion' => 'AV. TEST #321',
      'telefono' => '987654',
      'color' => '#ff7a11'
    ]);

    Empresa::create([
      'id' => '7',
      'ruc' => '78023696520',
      'nombre' => 'RUEDA DE NEGOCIOS',
      'direccion' => 'CALLE ARIZOLA #130 - B',
      'telefono' => '123789',
      'color' => '#F8BA0A'
    ]);
  }
}
