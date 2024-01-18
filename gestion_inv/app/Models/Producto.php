<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $table = 'productos';
     protected $fillable = [
        'prod_id',
        'cat_id',
        'prod_nombre',
        'prod_descripcion',
        'prod_sector',
        'prod_empresa'
    ];
    public function categoria (){
        return $this->belongsTo('App\Models\Categoria','cat_id');
    }
}
