<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    protected $fillable = ['cliente_id', 'servicio_id', 'mensaje_cliente'];
}
