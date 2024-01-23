<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    
    protected $table = 'categorias';

    protected $fillable = [
        'cat_nombre'
    ];

    protected $primaryKey = 'cat_id'; // Asegúrate de que esto coincida con la clave primaria en tu base de datos
}

