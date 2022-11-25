<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    protected $fillable = [
        'gec_id', 'ban_id', 'uni_id', 'fun_nome', 'fun_documento', 'fun_celular', 'fun_ativo'
    ];

    protected $table = 'funcionario';
}
