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
    // JM DESARROLLADOR
    Colaborador::create([
      'id' => '1',
      'nrodocumento' => '',
      'nombres' => 'JOHON ALEXANDER',
      'apellidos' => 'SALAZAR BAYGORRIA',
      'fechanacimiento' => '1980-11-25',
      'direccion' => '',
      'telefono' => '952982232',
      'empresa_area_id' => '1',
      'estado' => '1',
    ]);

    // Colaborador::create([
    //   'id' => '2',
    //   'nrodocumento' => '',
    //   'nombres' => 'MARCO ANTONIO',
    //   'apellidos' => 'GORDILLO ALCANTARA',
    //   'fechanacimiento' => '1982-08-16',
    //   'direccion' => '',
    //   'telefono' => '932400433',
    //   'empresa_area_id' => '2',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '3',
    //   'nrodocumento' => '',
    //   'nombres' => 'JOHNY',
    //   'apellidos' => 'FACHO POLO',
    //   'fechanacimiento' => '1967-11-16',
    //   'direccion' => '',
    //   'telefono' => '979947695',
    //   'empresa_area_id' => '3',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '4',
    //   'nrodocumento' => '',
    //   'nombres' => 'ELIANA JUDITH',
    //   'apellidos' => 'CHAPILLIQUEN ROJAS',
    //   'fechanacimiento' => '1998-07-01',
    //   'direccion' => '',
    //   'telefono' => '984970399',
    //   'empresa_area_id' => '4',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '5',
    //   'nrodocumento' => '',
    //   'nombres' => 'KAREN MELANYTH',
    //   'apellidos' => 'NUÑEZ CUSMA',
    //   'fechanacimiento' => '1992-11-03',
    //   'direccion' => '',
    //   'telefono' => '951088624',
    //   'empresa_area_id' => '5',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '6',
    //   'nrodocumento' => '',
    //   'nombres' => 'HARUMI DE MARIA',
    //   'apellidos' => 'YAMPUFE YABE',
    //   'fechanacimiento' => '1996-01-12',
    //   'direccion' => '',
    //   'telefono' => '978123791',
    //   'empresa_area_id' => '6',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '7',
    //   'nrodocumento' => '',
    //   'nombres' => 'ESWIN NOEL',
    //   'apellidos' => 'PEREZ PEREZ',
    //   'fechanacimiento' => '1991-02-21',
    //   'direccion' => '',
    //   'telefono' => '947007552',
    //   'empresa_area_id' => '7',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '8',
    //   'nrodocumento' => '',
    //   'nombres' => 'LAURA IRENE',
    //   'apellidos' => 'YACILA NAVARRO',
    //   'fechanacimiento' => '1999-06-11',
    //   'direccion' => '',
    //   'telefono' => '949108981',
    //   'empresa_area_id' => '8',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '9',
    //   'nrodocumento' => '',
    //   'nombres' => 'XIOMY LUSMIT',
    //   'apellidos' => 'VILLEGAS ALCALDE',
    //   'fechanacimiento' => '1994-05-06',
    //   'direccion' => '',
    //   'telefono' => '960399866',
    //   'empresa_area_id' => '8',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '10',
    //   'nrodocumento' => '',
    //   'nombres' => 'LUIS JESUS',
    //   'apellidos' => 'UCHOFEN GARCIA',
    //   'fechanacimiento' => '1995-11-16',
    //   'direccion' => '',
    //   'telefono' => '959688375',
    //   'empresa_area_id' => '9',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '11',
    //   'nrodocumento' => '',
    //   'nombres' => 'ABEL CRISTIAN',
    //   'apellidos' => 'SANTISTEBAN CHUMACERO',
    //   'fechanacimiento' => '1992-10-08',
    //   'direccion' => '',
    //   'telefono' => '936783242',
    //   'empresa_area_id' => '9',
    //   'estado' => '1',
    // ]);
    // // JM DESARROLLADOR

    // // NLEON
    // Colaborador::create([
    //   'id' => '12',
    //   'nrodocumento' => '',
    //   'nombres' => 'EDWIN ROBERT',
    //   'apellidos' => 'RODRIGUEZ RODAS',
    //   'fechanacimiento' => '1969-09-21',
    //   'direccion' => '',
    //   'telefono' => '917810803',
    //   'empresa_area_id' => '34',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '13',
    //   'nrodocumento' => '',
    //   'nombres' => 'JUAN JOSE',
    //   'apellidos' => 'RODRIGUEZ RODAS',
    //   'fechanacimiento' => '1982-06-24',
    //   'direccion' => '',
    //   'telefono' => '900769044',
    //   'empresa_area_id' => '10',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '14',
    //   'nrodocumento' => '',
    //   'nombres' => 'FRANK ALEXANDER',
    //   'apellidos' => 'RODRIGUEZ ZEVALLOS',
    //   'fechanacimiento' => '1993-12-01',
    //   'direccion' => '',
    //   'telefono' => '948832277',
    //   'empresa_area_id' => '10',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '15',
    //   'nrodocumento' => '',
    //   'nombres' => 'ANGEL MODESTO',
    //   'apellidos' => 'RODRIGUEZ ZEVALLOS',
    //   'fechanacimiento' => '1994-12-19',
    //   'direccion' => '',
    //   'telefono' => '948832277',
    //   'empresa_area_id' => '11',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '16',
    //   'nrodocumento' => '',
    //   'nombres' => 'VICTOR EDUARDO',
    //   'apellidos' => 'MERA ANDONAIRE',
    //   'fechanacimiento' => '1961-05-07',
    //   'direccion' => '',
    //   'telefono' => '9029840098',
    //   'empresa_area_id' => '10',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '17',
    //   'nrodocumento' => '',
    //   'nombres' => 'BRAYAN ALONSO',
    //   'apellidos' => 'PISFIL SALAZAR',
    //   'fechanacimiento' => '1999-03-19',
    //   'direccion' => '',
    //   'telefono' => '927659628',
    //   'empresa_area_id' => '12',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '18',
    //   'nrodocumento' => '',
    //   'nombres' => 'DARWIN WILFORD',
    //   'apellidos' => 'VILLANUEVA LEON',
    //   'fechanacimiento' => '2002-06-15',
    //   'direccion' => '',
    //   'telefono' => '912535409',
    //   'empresa_area_id' => '13',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '19',
    //   'nrodocumento' => '',
    //   'nombres' => 'MARY NANCY',
    //   'apellidos' => 'LEON CHAVEZ',
    //   'fechanacimiento' => '1982-08-16',
    //   'direccion' => '',
    //   'telefono' => '939766046',
    //   'empresa_area_id' => '14',
    //   'estado' => '1',
    // ]);
    // // NLEON

    // // GENEXIDU
    // Colaborador::create([
    //   'id' => '20',
    //   'nrodocumento' => '',
    //   'nombres' => 'JORGE RAMSET',
    //   'apellidos' => 'COELLO MALPARTIDA',
    //   'fechanacimiento' => '1987-01-21',
    //   'direccion' => '',
    //   'telefono' => '915235773',
    //   'empresa_area_id' => '15',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '21',
    //   'nrodocumento' => '',
    //   'nombres' => 'VANNESA JAZMIN',
    //   'apellidos' => 'BURGA ARCE',
    //   'fechanacimiento' => '1994-03-22',
    //   'direccion' => '',
    //   'telefono' => '942430270',
    //   'empresa_area_id' => '16',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '22',
    //   'nrodocumento' => '',
    //   'nombres' => 'OLGA ROSALIA',
    //   'apellidos' => 'MONTEZA PAZ',
    //   'fechanacimiento' => '1994-02-25',
    //   'direccion' => '',
    //   'telefono' => '901820881',
    //   'empresa_area_id' => '17',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '23',
    //   'nrodocumento' => '',
    //   'nombres' => 'LUIS DAVID',
    //   'apellidos' => 'LOPEZ VASQUEZ',
    //   'fechanacimiento' => '1996-07-12',
    //   'direccion' => '',
    //   'telefono' => '924643975',
    //   'empresa_area_id' => '18',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '24',
    //   'nrodocumento' => '',
    //   'nombres' => 'HECTOR',
    //   'apellidos' => 'VASQUEZ RAMIREZ',
    //   'fechanacimiento' => '1987-07-06',
    //   'direccion' => '',
    //   'telefono' => '944601873',
    //   'empresa_area_id' => '19',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '25',
    //   'nrodocumento' => '',
    //   'nombres' => 'ALEX JUNIOR',
    //   'apellidos' => 'ODAR NAVARRO',
    //   'fechanacimiento' => '1992-02-17',
    //   'direccion' => '',
    //   'telefono' => '935720245',
    //   'empresa_area_id' => '20',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '26',
    //   'nrodocumento' => '',
    //   'nombres' => 'JOSE LUIS',
    //   'apellidos' => 'PAICO YPANAQUE',
    //   'fechanacimiento' => '1992-03-19',
    //   'direccion' => '',
    //   'telefono' => '943911174',
    //   'empresa_area_id' => '20',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '27',
    //   'nrodocumento' => '',
    //   'nombres' => 'ANGIELY JERALDINE',
    //   'apellidos' => 'FLORES MEDINA',
    //   'fechanacimiento' => '2000-05-31',
    //   'direccion' => '',
    //   'telefono' => '948919980',
    //   'empresa_area_id' => '20',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '28',
    //   'nrodocumento' => '',
    //   'nombres' => 'JUNIOR',
    //   'apellidos' => 'PASACHE BUSTAMANTE',
    //   'fechanacimiento' => '2001-01-09',
    //   'direccion' => '',
    //   'telefono' => '918618539',
    //   'empresa_area_id' => '20',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '29',
    //   'nrodocumento' => '',
    //   'nombres' => 'MARCO AIRTON',
    //   'apellidos' => 'CABANILLAS GALVEZ',
    //   'fechanacimiento' => '1993-06-01',
    //   'direccion' => '',
    //   'telefono' => '930281506',
    //   'empresa_area_id' => '20',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '30',
    //   'nrodocumento' => '',
    //   'nombres' => 'GUSTAVO ADOLFO',
    //   'apellidos' => 'CAICEDO SUYON',
    //   'fechanacimiento' => '1992-01-24',
    //   'direccion' => '',
    //   'telefono' => '902165570',
    //   'empresa_area_id' => '21',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '31',
    //   'nrodocumento' => '',
    //   'nombres' => 'BRAYN XAVIER',
    //   'apellidos' => 'CORTEZ LINARES',
    //   'fechanacimiento' => '1994-08-14',
    //   'direccion' => '',
    //   'telefono' => '930775939',
    //   'empresa_area_id' => '22',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '32',
    //   'nrodocumento' => '',
    //   'nombres' => 'MARCO MAURICIO',
    //   'apellidos' => 'SEMINARIO CHAVARRY',
    //   'fechanacimiento' => '1994-08-17',
    //   'direccion' => '',
    //   'telefono' => '9790199991',
    //   'empresa_area_id' => '23',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '33',
    //   'nrodocumento' => '',
    //   'nombres' => 'CESAR AUGUSTO',
    //   'apellidos' => 'TELLO HUANAMBAL',
    //   'fechanacimiento' => '1997-12-02',
    //   'direccion' => '',
    //   'telefono' => '964722835',
    //   'empresa_area_id' => '24',
    //   'estado' => '1',
    // ]);
    // // GENEXIDU

    // // JM INMOBILIARIA
    // Colaborador::create([
    //   'id' => '34',
    //   'nrodocumento' => '',
    //   'nombres' => 'LISBETH YANARI',
    //   'apellidos' => 'RIVERA ROJAS',
    //   'fechanacimiento' => '1991-10-11',
    //   'direccion' => '',
    //   'telefono' => '993099352',
    //   'empresa_area_id' => '25',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '35',
    //   'nrodocumento' => '',
    //   'nombres' => 'KENNY BRYAN',
    //   'apellidos' => 'AGUIRRE ZEVALLOS',
    //   'fechanacimiento' => '1993-04-23',
    //   'direccion' => '',
    //   'telefono' => '970404047',
    //   'empresa_area_id' => '26',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '36',
    //   'nrodocumento' => '',
    //   'nombres' => 'FIORELLA MEDALY',
    //   'apellidos' => 'HUAMAN SANCHEZ',
    //   'fechanacimiento' => '1992-02-13',
    //   'direccion' => '',
    //   'telefono' => '952699045',
    //   'empresa_area_id' => '26',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '37',
    //   'nrodocumento' => '',
    //   'nombres' => 'RAMIRO EDGARDO',
    //   'apellidos' => 'TICERAN PEREZ',
    //   'fechanacimiento' => '1992-07-04',
    //   'direccion' => '',
    //   'telefono' => '943694270',
    //   'empresa_area_id' => '26',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '38',
    //   'nrodocumento' => '',
    //   'nombres' => 'PIERRE AUGUSTO',
    //   'apellidos' => 'FIGUEROA GONZALES',
    //   'fechanacimiento' => '1987-08-02',
    //   'direccion' => '',
    //   'telefono' => '973452011',
    //   'empresa_area_id' => '26',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '39',
    //   'nrodocumento' => '',
    //   'nombres' => 'VANESSA',
    //   'apellidos' => 'CHUMACERO TORRES',
    //   'fechanacimiento' => '1987-08-02',
    //   'direccion' => '',
    //   'telefono' => '957400508',
    //   'empresa_area_id' => '26',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '40',
    //   'nrodocumento' => '',
    //   'nombres' => 'ANTHONY ARNOLD',
    //   'apellidos' => 'SANDOVAL VALENZUELA',
    //   'fechanacimiento' => '1994-05-17',
    //   'direccion' => '',
    //   'telefono' => '930457563',
    //   'empresa_area_id' => '27',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '41',
    //   'nrodocumento' => '',
    //   'nombres' => 'KELLIE',
    //   'apellidos' => 'MONTERO CARRASCO',
    //   'fechanacimiento' => '1994-05-17',
    //   'direccion' => '',
    //   'telefono' => '',
    //   'empresa_area_id' => '28',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '42',
    //   'nrodocumento' => '',
    //   'nombres' => 'NANLU YASMIN',
    //   'apellidos' => 'PALACIOS CLAVIJO',
    //   'fechanacimiento' => '1984-10-31',
    //   'direccion' => '',
    //   'telefono' => '979447884',
    //   'empresa_area_id' => '28',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '43',
    //   'nrodocumento' => '',
    //   'nombres' => 'ISABEL DEL MILAGRO',
    //   'apellidos' => 'CHAVEZ DELGADO',
    //   'fechanacimiento' => '1998-10-04',
    //   'direccion' => '',
    //   'telefono' => '926608588',
    //   'empresa_area_id' => '28',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '44',
    //   'nrodocumento' => '',
    //   'nombres' => 'SANDRO',
    //   'apellidos' => 'CHAVEZ LOPEZ',
    //   'fechanacimiento' => '1994-05-03',
    //   'direccion' => '',
    //   'telefono' => '902955045',
    //   'empresa_area_id' => '26',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '45',
    //   'nrodocumento' => '',
    //   'nombres' => 'DANTE',
    //   'apellidos' => 'PORRAS DELGADO',
    //   'fechanacimiento' => '1988-02-12',
    //   'direccion' => '',
    //   'telefono' => '963046270',
    //   'empresa_area_id' => '26',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '52',
    //   'nrodocumento' => '',
    //   'nombres' => 'ALBERTO',
    //   'apellidos' => 'RODRIGUEZ CABREJOS',
    //   'fechanacimiento' => '1994-04-03',
    //   'direccion' => '',
    //   'telefono' => '937817789',
    //   'empresa_area_id' => '27',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '53',
    //   'nrodocumento' => '',
    //   'nombres' => 'CRISTIAN BRAYAN',
    //   'apellidos' => 'JESUS VERA ROMERO',
    //   'fechanacimiento' => '1999-06-15',
    //   'direccion' => '',
    //   'telefono' => '923636417',
    //   'empresa_area_id' => '27',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '54',
    //   'nrodocumento' => '',
    //   'nombres' => 'JUNIOR',
    //   'apellidos' => 'CARRASCO HUAMAN',
    //   'fechanacimiento' => '1999-03-19',
    //   'direccion' => '',
    //   'telefono' => '958521164',
    //   'empresa_area_id' => '27',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '55',
    //   'nrodocumento' => '',
    //   'nombres' => 'ROCIO',
    //   'apellidos' => 'VILLEGAS YALLE',
    //   'fechanacimiento' => '1999-03-19',
    //   'direccion' => '',
    //   'telefono' => '958521164',
    //   'empresa_area_id' => '27',
    //   'estado' => '1',
    // ]);
    // // JM INMOBILIARIA


    // // COMPUSISTEL
    // Colaborador::create([
    //   'id' => '46',
    //   'nrodocumento' => '',
    //   'nombres' => 'OSCAR REMIGIO',
    //   'apellidos' => 'SALAZAR BAIGORRIA',
    //   'fechanacimiento' => '1971-06-17',
    //   'direccion' => '',
    //   'telefono' => '934845616',
    //   'empresa_area_id' => '29',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '47',
    //   'nrodocumento' => '',
    //   'nombres' => 'JANINA MARICRUZ',
    //   'apellidos' => 'RIVAS CABREJOS',
    //   'fechanacimiento' => '1995-12-16',
    //   'direccion' => '',
    //   'telefono' => '914845464',
    //   'empresa_area_id' => '30',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '48',
    //   'nrodocumento' => '',
    //   'nombres' => 'MARYOEI YASLITD',
    //   'apellidos' => 'TEJADA ISUIZA',
    //   'fechanacimiento' => '1997-02-28',
    //   'direccion' => '',
    //   'telefono' => '9708544239',
    //   'empresa_area_id' => '31',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '49',
    //   'nrodocumento' => '',
    //   'nombres' => 'DAVID',
    //   'apellidos' => 'MANAYALLE CACHAY',
    //   'fechanacimiento' => '1996-10-30',
    //   'direccion' => '',
    //   'telefono' => '991817883',
    //   'empresa_area_id' => '32',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '50',
    //   'nrodocumento' => '',
    //   'nombres' => 'KATHIA BIBIANA',
    //   'apellidos' => 'CRUZADO CHAVEZ',
    //   'fechanacimiento' => '1997-12-14',
    //   'direccion' => '',
    //   'telefono' => '995092702',
    //   'empresa_area_id' => '31',
    //   'estado' => '1',
    // ]);

    // Colaborador::create([
    //   'id' => '51',
    //   'nrodocumento' => '',
    //   'nombres' => 'JUAN MIGUEL',
    //   'apellidos' => 'DIAZ HERNANDEZ',
    //   'fechanacimiento' => '1992-03-16',
    //   'direccion' => '',
    //   'telefono' => '978998786',
    //   'empresa_area_id' => '33',
    //   'estado' => '1',
    // ]);
    // // COMPUSISTEL
  }
}
