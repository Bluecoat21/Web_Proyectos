<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    protected $table = 'proyectos'; // Correcto según tu imagen
    
    // Agrega esto para permitir que Laravel guarde los datos
    protected $fillable = ['titulo', 'caratula', 'pdf', 'categoria']; 
}
