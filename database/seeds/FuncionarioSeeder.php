<?php

use App\Funcionario;
use App\Unidade;
use Faker\Factory;
use Illuminate\Database\Seeder;

class FuncionarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('pt_BR');

        $unidades = Unidade::all();

        foreach ($unidades as $unidade) {

            for ($i=0; $i<rand(5,15); $i++) {
                Funcionario::create([
                    'gec_id' => $unidade->gec_id,
                    'ban_id' => $unidade->ban_id,
                    'uni_id' => $unidade->id,
                    'fun_nome' => $faker->name,
                    'fun_documento' => $faker->cpf(false),
                    'fun_celular' => $faker->areaCode . $faker->landline(false)
                ]);
            }
        }
    }
}
