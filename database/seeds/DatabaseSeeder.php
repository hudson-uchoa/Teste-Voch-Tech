<?php

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
        $this->call(GrupoEconomicoSeeder::class);
        $this->call(BandeiraSeeder::class);
        $this->call(UnidadeSeeder::class);
        $this->call(FuncionarioSeeder::class);
    }
}
