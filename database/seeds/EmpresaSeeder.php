<?php

use Illuminate\Database\Seeder;
use App\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Empresa::create([
            'id' => 1,
            'ruc' => '10408842889',
            'nombre' => 'COMPUSISTEM',
            'direccion' => 'AV. TEST #123',
            'telefono' => '123456',
        ]);
    }
}
