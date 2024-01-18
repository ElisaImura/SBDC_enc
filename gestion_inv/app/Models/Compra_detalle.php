<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra_detalle extends Model
{
    use HasFactory;
    public $table = 'compra_detalles';
     protected $fillable = [
        'dcompra_id',
        'compra_id',
        'prod_id',
        'dcompra_precio',
        'dcompra_cantidad',
        'dcompra_iva'
    ];
    public function compra (){
        return $this->belongsTo('App\Models\Compra','compra_id');
    }
    public function producto (){
        return $this->belongsTo('App\Models\Producto','prod_id');
    }
}
