<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresupuestoDetalleTemp extends Model
{
    use HasFactory;
    protected $primaryKey = 'temp_id';
    public $table = 'Presupuesto_temp_venta_detalles';
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
