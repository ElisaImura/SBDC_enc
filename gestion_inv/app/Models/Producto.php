<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $primaryKey = 'prod_id';

    protected $fillable = [
        'prod_id',
        'cat_id',
        'prod_nombre',
        'prod_descripcion',
        'prod_cant',
        'prod_precioventa',
        'prod_preciocosto',
        'prod_imagen'
    ];

    public $incrementing = false;

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria', 'cat_id');
    }

    public function detallesVentas()
    {
        return $this->hasMany(Venta_detalle::class);
    }
}
