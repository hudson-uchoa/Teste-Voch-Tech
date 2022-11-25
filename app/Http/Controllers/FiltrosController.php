<?php

namespace App\Http\Controllers;

use App\Bandeira;
use App\Funcionario;
use App\GrupoEconomico;
use App\Unidade;
use Illuminate\Http\Request;
use App\Traits\Filtros;

class FiltrosController extends Controller
{
    public function index()
    {
        $filtros = $this->montarFiltros(['gruposEconomicos', 'bandeiras', 'unidades', 'funcionarios']);
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

    public function bandeiras(Request $req)
    {
        switch ($req->bandeirasPesquisa) {
            case '2':
                $campos = ['ban_documento', 'ban_nome'];
                break;
            default:
                $campos = ['id', 'ban_nome'];
                break;
        }

        $bandeiras = Bandeira::select('id', 'ban_nome', 'ban_documento', 'ban_ativo')
            ->where(function ($query) use ($req, $campos) {
                foreach ($campos as $campo) {
                    $query->orWhere($campo, 'like', '%' . $req->pesquisa . '%');
                }
            })
            ->paginate();

        $resultado = [];
        foreach ($bandeiras as $bandeira) {
            $resultado[] = [
                'id' => $bandeira->id,
                'text' => $bandeira->{$campos[0]} . '-' . $bandeira->{$campos[1]}
            ];
        }

        return response()->json([
            'results' => $resultado,
            'pagination' => [
                'more' => $bandeiras->hasMorePages(),
            ],
        ]);
    }

    public function unidades(Request $req)
    {
        switch ($req->unidadesPesquisa) {
            case '2':
                $campos = ['uni_documento', 'uni_nome_fantasia'];
                break;

            case '3':
                $campos = ['uni_documento', 'uni_razao_social'];
                break;

            default:
                $campos = ['id', 'uni_nome_fantasia'];
                break;
        }

        $unidades = Unidade::select('id', 'uni_nome_fantasia', 'uni_documento', 'uni_razao_social')
            ->where(function ($query) use ($req, $campos) {
                foreach ($campos as $campo) {
                    $query->orWhere($campo, 'like', '%' . $req->pesquisa . '%');
                }
            })
            ->paginate();

        $resultado = [];
        foreach ($unidades as $unidade) {
            $resultado[] = [
                'id' => $unidade->id,
                'text' => $unidade->{$campos[0]} . '-' . $unidade->{$campos[1]}
            ];
        }

        return response()->json([
            'results' => $resultado,
            'pagination' => [
                'more' => $unidades->hasMorePages(),
            ],
        ]);
    }

    public function funcionarios(Request $req)
    {

        switch ($req->funcionariosPesquisa) {
            case '2':
                $campos = ['fun_documento', 'fun_nome'];
                break;

            case '3':
                $campos = ['fun_nome', 'uni_nome_fantasia'];
                break;

            default:
                $campos = ['funcionario.id', 'fun_nome'];
                break;
        }

        $funcionarios = Funcionario::select('funcionario.id', 'funcionario.fun_nome', 'funcionario.fun_documento', 'unidade.uni_nome_fantasia')
            ->join('unidade', 'funcionario.uni_id', '=', 'unidade.id')
            ->where(function ($query) use ($req, $campos) {
                foreach ($campos as $campo) {
                    $query->orWhere($campo, 'like', '%' . $req->pesquisa . '%');
                }
            })
            ->paginate();

        $resultado = [];

        foreach ($funcionarios as $funcionario) {

            if ($campos[0] === 'funcionario.id') {
                $resultado[] = [
                    'id' => $funcionario->id,
                    'text' => $funcionario->id . '-' . $funcionario->{$campos[1]}
                ];
            } else {
                $resultado[] = [
                    'id' => $funcionario->id,
                    'text' => $funcionario->{$campos[0]} . '-' . $funcionario->{$campos[1]}
                ];
            }
        }




        return response()->json([
            'results' => $resultado,
            'pagination' => [
                'more' => $funcionarios->hasMorePages(),
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

        $filtros['bandeiras'] = [
            'pesquisa' => [
                1 => [
                    'texto' => 'Código e Nome',
                    'placeholder' => 'Pesquise por código ou nome',
                ],
                2 => [
                    'texto' => 'Documento e Nome',
                    'placeholder' => 'Pesquise por nome, cpf ou cnpj',
                ],
            ],
            'atividade' => [
                1 => 'Ativo',
                0 => 'Inativo',
            ],
            'multiplo' => true,
            'titulo' => 'Bandeiras',
            'nome' => 'bandeiras',
            'placeholder' => 'Pesquise bandeiras',
            'rota' => route('filtros.bandeira'),
        ];

        $filtros['unidades'] = [
            'pesquisa' => [
                1 => [
                    'texto' => 'Código e Nome fantasia',
                    'placeholder' => 'Pesquise por código ou nome fantasia',
                ],
                2 => [
                    'texto' => 'Documento e Nome fantasia',
                    'placeholder' => 'Pesquise por código ou nome fantasia',
                ],
                3 => [

                    'texto' => 'Documento e Razão social',
                    'placeholder' => 'Pesquise por documento, cpf ou cnpj',
                ],
            ],
            'atividade' => [
                1 => 'Ativo',
                0 => 'Inativo',
            ],
            'multiplo' => true,
            'titulo' => 'Unidades',
            'nome' => 'unidades',
            'placeholder' => 'Pesquise unidades',
            'rota' => route('filtros.unidade'),
        ];

        $filtros['funcionarios'] = [
            'pesquisa' => [
                1 => [
                    'texto' => 'Código e Nome',
                    'placeholder' => 'Pesquise por código ou nome',
                ],
                2 => [
                    'texto' => 'Documento e Nome',
                    'placeholder' => 'Pesquise por código ou nome',
                ],
                3 => [
                    'texto' => 'Nome e Nome fantasia',
                    'placeholder' => ' Pesquise por nome ou nome fantasia da unidade',
                ],
            ],
            'atividade' => [
                1 => 'Ativo',
                0 => 'Inativo',
            ],
            'multiplo' => true,
            'titulo' => 'Funcionarios',
            'nome' => 'funcionarios',
            'placeholder' => 'Pesquise funcionarios',
            'rota' => route('filtros.funcionario'),
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
