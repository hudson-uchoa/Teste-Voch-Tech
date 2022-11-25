<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GrupoEconomico extends Model
{
    protected $fillable = [
        'gec_razao_social', 'gec_nome_fantasia', 'gec_documento', 'gec_ativo'
    ];

    protected $table = 'grupo_economico';

}
