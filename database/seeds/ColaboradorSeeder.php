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
    Colaborador::create([
      'id' => '1',
      'nrodocumento' => '40986266',
      'nombres' => 'JOHON ALEXANDER',
      'apellidos' => 'SALAZAR BAYGORRIA',
      'fechanacimiento' => '1980-11-25',
      'direccion' => 'CALLE SANTA ROSA N°185 P.J SANTA ROSA',
      'prefijo' => '51',
      'telefono' => '952982232',
      'estado' => '1',
    ]);
  }
}
