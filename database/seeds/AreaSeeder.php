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

    // JM DESARROLLADOR
    Area::create([
      'id' => '2',
      'nombre' => 'GERENTE  DE PROYECTOS',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '3',
      'nombre' => 'JEFE DE ARQUITECTURA',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '4',
      'nombre' => 'ASISTENTE DE ARQUITECTURA',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '5',
      'nombre' => 'ING ESTRUCTURAL',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '6',
      'nombre' => 'ARQUITECTA',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '7',
      'nombre' => 'INGENIERO CIVIL',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '8',
      'nombre' => 'DISEÑADORA DE INTERIORES',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '9',
      'nombre' => 'PROYECTISTA DISEÑADOR',
      'estado' => '1'
    ]);
    // JM DESARROLLADOR

    // NLEON
    Area::create([
      'id' => '10',
      'nombre' => 'ASISTENTE DE OPERACIONES',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '11',
      'nombre' => 'JEFE DE OPERACIONES',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '12',
      'nombre' => 'ASISTENTE DE LOGISTICA',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '13',
      'nombre' => 'ASISTENTE DE LIMPIEZA',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '14',
      'nombre' => 'DIRECTORA CONTABLE',
      'estado' => '1'
    ]);
    // NLEON


    // GENEXIDU
    Area::create([
      'id' => '15',
      'nombre' => 'JEFE DE AREA DE MARKETING',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '16',
      'nombre' => 'COMUNICADORA',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '17',
      'nombre' => 'REALIZADOR AUDIOVISUALES',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '18',
      'nombre' => 'JEFE DE AREA DE DISEÑO',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '19',
      'nombre' => 'PRODUCTOR AUDIOVISUAL',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '20',
      'nombre' => 'DISEÑADOR GRAFICO',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '21',
      'nombre' => 'JEFE DE AREA AUDIOVISUAL',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '22',
      'nombre' => 'GERENTE DE MARKETING',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '23',
      'nombre' => 'COMMUNITY MANAGER',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '24',
      'nombre' => 'ASISTENTE AUDIOVISUALES',
      'estado' => '1'
    ]);
    // GENEXIDU


    // JM INMOBILIARIA
    Area::create([
      'id' => '25',
      'nombre' => 'GERENTE ADMINISTRATIVO',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '26',
      'nombre' => 'SUPERVISOR COMERCIAL',
      'estado' => '1'
    ]);


    Area::create([
      'id' => '27',
      'nombre' => 'AGENTE COMERCIAL',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '28',
      'nombre' => 'ASISTENTE ADMINISTRATIVO',
      'estado' => '1'
    ]);
    // JM INMOBILIARIA


    // COMPUSISTEL
    Area::create([
      'id' => '29',
      'nombre' => 'GERENTE ADMINISTRATIVO',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '30',
      'nombre' => 'JEFE DE AREA',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '31',
      'nombre' => 'ASISTENTE DE COMPUTACION E INFORMATICA',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '32',
      'nombre' => 'ASISTENTE DE SISTEMAS',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '33',
      'nombre' => 'PROGRAMADOR JUNIOR',
      'estado' => '1'
    ]);
    // COMPUSISTEL


    // JM HOLDING
    Area::create([
      'id' => '34',
      'nombre' => 'ASISTENTE LEGAL',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '35',
      'nombre' => 'JEFE DE RRHH Y LOGISTICA',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '37',
      'nombre' => 'ASISTENTE DE RRHH',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '38',
      'nombre' => 'ASISTENTE CONTABLE',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '39',
      'nombre' => 'CONTADORA GENERAL',
      'estado' => '1'
    ]);
    // JM HOLDING


    // RUEDA DE NEGOCIOS
    Area::create([
      'id' => '40',
      'nombre' => 'PUBLICIDAD',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '41',
      'nombre' => 'JEFE DE CAPACITACIONES',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '45',
      'nombre' => 'SUPERVISOR DE CUENTAS',
      'estado' => '1'
    ]);

    Area::create([
      'id' => '46',
      'nombre' => 'PRACTICANTE',
      'estado' => '1'
    ]);
    // RUEDA DE NEGOCIOS

  }
}
