<?php

use Illuminate\Database\Seeder;
use App\RequerimientoEncargados;

class RequerimientoEncargadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        RequerimientoEncargados::create([
            'requerimiento_id' => '1',
            'usuarioencarg_id' => '3'
        ]);

    }
}
