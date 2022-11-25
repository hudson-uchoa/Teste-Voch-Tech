<?php

use App\GrupoEconomico;
use Faker\Factory;
use Illuminate\Database\Seeder;


class GrupoEconomicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('pt_BR');
        for ($i=0; $i<10; $i++) {

            $empresa = $faker->company;

            GrupoEconomico::create([
                'gec_razao_social' => $empresa,
                'gec_nome_fantasia' => $empresa,
                'gec_documento' => $faker->cnpj(false)
            ]);
        }
    }
}
