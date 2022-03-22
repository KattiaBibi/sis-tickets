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
        //

        EmpresaArea::create([
            'id'=>'1',
            'empresa_id'=>'1',
            'area_id'=>'1',

        ]);

    }
}
