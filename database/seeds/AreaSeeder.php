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
        //

        Area::create([
            'id' => '1',
            'nombre' => 'GERENCIA',
            'estado' => '1'
        ]);

        Area::create([
            'id' => '2',
            'nombre' => 'DESARROLLO DE SOFTWARE',
            'estado' => '1'
        ]);

        Area::create([
            'id' => '3',
            'nombre' => 'SOPORTE',
            'estado' => '1'
        ]);

        Area::create([
            'id' => '4',
            'nombre' => 'RECURSOS HUMANOS',
            'estado' => '1'
        ]);

        Area::create([
            'id' => '5',
            'nombre' => 'CONTABILIDAD',
            'estado' => '1'
        ]);

        Area::create([
            'id' => '6',
            'nombre' => 'DISEÑO GRÁFICO',
            'estado' => '1'
        ]);

        Area::create([
            'id' => '7',
            'nombre' => 'AUDIOVISUALES',
            'estado' => '1'
        ]);
    }
}
