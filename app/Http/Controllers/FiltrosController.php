<?php

namespace App\Http\Controllers;

use App\GrupoEconomico;
use App\Traits\Filtros;
use Illuminate\Http\Request;

class FiltrosController extends Controller
{
    public function index()
    {
        $filtros = $this->montarFiltros(['gruposEconomicos']);
        return view('pesquisas', compact('filtros'));
    }

    public function gruposEconomicos(Request $req)
    {
        switch ($req->gruposEconomicosPesquisa) {
            case '2':
                $campos = ['gec_documento', 'gec_nome_fantasia'];
                break;
            default: 
                $campos = ['id', 'gec_razao_social'];
                break;
        }
        $gruposEconomicos = GrupoEconomico::select('id', 'gec_nome_fantasia', 'gec_razao_social', 'gec_documento')
            ->where(function ($query) use ($req, $campos) {
                foreach ($campos as $campo) {
                    $query->orWhere($campo, 'like', '%' . $req->pesquisa . '%');
                }
            })
            ->paginate();

        $resultado = [];
        foreach ($gruposEconomicos as $gruposEconomico) {
            $resultado[] = [
                'id' => $gruposEconomico->id,
                'text' => $gruposEconomico->{$campos[0]} . '-' . $gruposEconomico->{$campos[1]}
            ];
        }

        return response()->json([
            'results' => $resultado,
            'pagination' => [
                'more' => $gruposEconomicos->hasMorePages(),
            ],
        ]);
    }

    private function montarFiltros(array $campos)
    {
        $filtros['gruposEconomicos'] = [
            'pesquisa' => [
                1 => [
                    'texto' => 'Código e Nome',
                    'placeholder' => 'Pesquise por código ou nome',
                ],
                2 => [
                    'texto' => 'Documento e Nome fantasia',
                    'placeholder' => 'Pesquise por nome fantasia, cpf ou cnpj',
                ],
            ],
            'atividade' => [
                1 => 'Ativo',
                0 => 'Inativo',
            ],
            'multiplo' => true,
            'titulo' => 'Grupos Econômicos',
            'nome' => 'gruposEconomicos',
            'placeholder' => 'Pesquise grupos econômicos',
            'rota' => route('filtros.grupoEconomico'),
        ];

        $result = [];
        foreach ($filtros as $filtro => $dados) {
            if (!in_array($filtro, $campos))
                continue;

            $result[$filtro] = view('filtrosAjax', compact('dados'))->render();
        }

        return $result;
    }
}
