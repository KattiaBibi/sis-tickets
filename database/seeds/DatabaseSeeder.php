<?php

use App\EmpresaServicio;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RoleSeeder::class);

         $this->call(EmpresaSeeder::class);

         $this->call(AreaSeeder::class);

         $this->call(EmpresaAreasSeeder::class);

         $this->call(ColaboradorSeeder::class);

         $this->call(UserSeeder::class);
         
         $this->call(ServicioSeeder::class);

         $this->call(EmpresaServicioSeeder::class);

         $this->call(RequerimientoSeeder::class);
    }
}
