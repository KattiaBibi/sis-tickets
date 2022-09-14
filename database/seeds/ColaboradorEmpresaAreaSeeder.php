<?php

use App\ColaboradorEmpresaArea;
use Illuminate\Database\Seeder;

class ColaboradorEmpresaAreaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    ColaboradorEmpresaArea::create([
      'correo_corporativo' => 'gerencia@genexidu.com',
      'colaborador_id' => '1',
      'empresa_area_id' => '3',
    ]);

    ColaboradorEmpresaArea::create([
      'correo_corporativo' => 'gerencia@jmdesarrollador.com',
      'colaborador_id' => '1',
      'empresa_area_id' => '1',
    ]);

    ColaboradorEmpresaArea::create([
      'correo_corporativo' => 'gerencia@jminmobiliarias.com',
      'colaborador_id' => '1',
      'empresa_area_id' => '4',
    ]);

    ColaboradorEmpresaArea::create([
      'correo_corporativo' => 'gerencia@ruedadenegocios.pe',
      'colaborador_id' => '1',
      'empresa_area_id' => '7',
    ]);
  }
}
