<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
    protected $fillable = [
        'gec_id', 'ban_id', 'uni_razao_social', 'uni_nome_fantasia', 'uni_documento', 'uni_ativo'
    ];

    protected $table = 'unidade';
}
