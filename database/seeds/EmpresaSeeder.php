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
            'nombre' => 'COMPUSISTEL',
            'direccion' => 'AV. TEST #123',
            'telefono' => '123456',
            'color' => '#0000ff'
        ]);

        Empresa::create([
            'id' => 2,
            'ruc' => '12546454564',
            'nombre' => 'JM HOLDING',
            'direccion' => 'AV. TEST #321',
            'telefono' => '987654',
            'color' => '#ff7a11'
        ]);

        Empresa::create([
            'id' => 3,
            'ruc' => '78423233232',
            'nombre' => 'GENEXIDU',
            'direccion' => 'AV. TEST #213',
            'telefono' => '123789',
            'color' => '#00e0ba'
        ]);
    }
}
