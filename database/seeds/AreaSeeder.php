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
            'id'=>'1',
            'nombre'=>'SOPORTE',
            'estado_id'=>'1'
        ]);

        Area::create([
            'id'=>'2',
            'nombre'=>'DESARROLLO DE SOFTWARE',
            'estado_id'=>'1'
        ]);
    }
}