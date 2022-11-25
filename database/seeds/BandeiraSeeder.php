<?php

use App\Bandeira;
use App\GrupoEconomico;
use Faker\Factory;
use Illuminate\Database\Seeder;


class BandeiraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('pt_BR');

        $gruposEconomicos = GrupoEconomico::pluck('id');

        foreach ($gruposEconomicos as $grupoEconomico) {
            for ($i=0; $i<3; $i++) {     
                Bandeira::create([
                    'gec_id' => $grupoEconomico,
                    'ban_nome' => $faker->company,
                    'ban_documento' => $faker->cnpj(false)
                ]);
            }
        }

    }
}
