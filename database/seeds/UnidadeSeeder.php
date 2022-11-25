<?php

use App\Bandeira;
use App\Unidade;
use Faker\Factory;
use Illuminate\Database\Seeder;

class UnidadeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('pt_BR');

        $bandeiras = Bandeira::all();

        foreach ($bandeiras as $bandeira) {

            for ($i=0; $i<rand(1,5); $i++) {

                $empresa = $faker->company;
                Unidade::create([
                    'gec_id' => $bandeira->gec_id,
                    'ban_id' => $bandeira->id,
                    'uni_razao_social' => $empresa,
                    'uni_nome_fantasia' => $empresa,
                    'uni_documento' => $faker->cnpj(false)
                ]);
            }
        }
    }
}
