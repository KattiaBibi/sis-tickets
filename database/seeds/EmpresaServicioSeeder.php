<?php

use App\EmpresaServicio;
use Illuminate\Database\Seeder;

class EmpresaServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmpresaServicio::create([
            'empresa_id' => '1',
            'servicio_id' => '1',
        ]);

        EmpresaServicio::create([
            'empresa_id' => '3',
            'servicio_id' => '2',
        ]);
    }
}
