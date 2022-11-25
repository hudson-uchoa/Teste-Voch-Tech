<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bandeira extends Model
{
    protected $fillable = [
        'gec_id', 'ban_nome', 'ban_documento', 'ban_ativo'
    ];

    protected $table = 'bandeira';
}
