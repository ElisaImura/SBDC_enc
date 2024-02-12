<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempCompra extends Model
{
    use HasFactory;
    protected $primaryKey = 'temp_id';
    public $table = 'temp_compra_detalles';
     protected $fillable = [
        'dcompra_id',  
        'prod_id',  
        'dcompra_precio',
        'dcompra_pcompra',
        'dcompra_pventa',
        'dcompra_cantidad',
    ];
    public function producto (){
        return $this->belongsTo('App\Models\Producto','prod_id');
    }
}
