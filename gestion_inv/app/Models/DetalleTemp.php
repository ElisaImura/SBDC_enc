<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleTemp extends Model
{
    use HasFactory;
    public $table = 'temp_venta_detalles';
     protected $fillable = [
        'dventa_id',  
        'prod_id',  
        'dventa_precio',
        'dventa_cantidad',
    ];
    public function producto (){
        return $this->belongsTo('App\Models\Producto','prod_id');
    }
}

