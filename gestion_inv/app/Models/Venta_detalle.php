<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta_detalle extends Model
{
    use HasFactory;

    public $table = 'venta_detalles';
    protected $primaryKey = 'dventa_id';
     protected $fillable = [
        'venta_id',   
        'prod_id',     
        'compra_id',
        'dventa_precio',
        'dventa_cantidad',
    ];
    public function venta (){
        return $this->belongsTo('App\Models\venta','venta_id');
    }
    public function producto (){
        return $this->belongsTo('App\Models\Producto','prod_id');
    }
}

