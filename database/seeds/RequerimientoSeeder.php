<?php

use App\Requerimiento;
use Illuminate\Database\Seeder;

class RequerimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Requerimiento::create([
            'titulo' => 'TEST DE REGISTRO',
            'descripcion' => 'TEST DESCRIPCION REGISTRO 1',
            'avance' => 0,
            'prioridad' => 'media',
            'estado' => 'pendiente',
            'empresa_servicio_id' => '2',
            'usuarioregist_id' => '1',

        ]);

        Requerimiento::create([
            'titulo' => 'TEST DE REGISTRO 2',
            'descripcion' => 'TEST DESCRIPCION REGISTRO 2',
            'avance' => 0,
            'prioridad' => 'alta',
            'estado' => 'pendiente',
            'empresa_servicio_id' => '1',
            'usuarioregist_id' => '3',

        ]);

        Requerimiento::create([
            'titulo' => 'TEST DE REGISTRO 3',
            'descripcion' => 'TEST DESCRIPCION REGISTRO 3',
            'avance' => 0,
            'prioridad' => 'baja',
            'estado' => 'pendiente',
            'empresa_servicio_id' => '2',
            'usuarioregist_id' => '1',

        ]);

    }
}
