<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    public $table = 'categorias';
     protected $fillable = [
        'cat_id',
        'cat_nombre'
    ];
}
