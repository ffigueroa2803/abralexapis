<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'CO_Documento';

    protected $hidden = ['ClienteRUC', 'CompaniaSocio'];
}
