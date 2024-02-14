<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public $table = 'ventas';
    protected $primaryKey = 'venta_id';
     protected $fillable = [
        'cli_id',
        'venta_fecha'
    ];
    public function cliente (){
        return $this->belongsTo('App\Models\Cliente','cli_id');
    }

    public function venta_detalle()
    {
        return $this->hasMany(Venta_detalle::class);
    }
    public function detalles()
    {
        return $this->hasMany(Venta_detalle::class, 'venta_id'); // 'compra_id' es el nombre de la clave foránea en la tabla compra_detalles
    }

    
}
