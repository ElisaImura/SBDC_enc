<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta_detalle extends Model
{
    use HasFactory;
    public $table = 'compra_detalles';
     protected $fillable = [
        'dventa_id',
        'venta_id',        
        'compra_id',
        'cli_id',
        'dventa_precio',
        'dventa_cantidad',
        'dventa_iva'
    ];
    public function venta (){
        return $this->belongsTo('App\Models\venta','venta_id');
    }
    public function producto (){
        return $this->belongsTo('App\Models\Producto','prod_id');
    }
}
