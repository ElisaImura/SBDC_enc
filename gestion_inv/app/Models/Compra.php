<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    public $table = 'compras';
    protected $primaryKey = 'compra_id';
     protected $fillable = [
        'compra_id',
        'prove_id',
        'compra_fecha',
        'compra_factura'
    ];
    public function proveedor (){
        return $this->belongsTo('App\Models\Proveedor','prove_id');
    }
    public function detalles()
    {
        return $this->hasMany(Compra_detalle::class, 'compra_id'); // 'compra_id' es el nombre de la clave foránea en la tabla compra_detalles
    }
}
