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
            'descripcion' => 'TEST DESCRIPCION REGISTRO',
            'avance' => 0,
            'prioridad' => 'media',
            'estado' => 'pendiente',
            'empresa_servicio_id' => '1',
            'usuarioregist_id' => '1',
            'usuarioencarg_id' => '2'
        ]);
    }
}
