<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public $table = 'ventas';
     protected $fillable = [
        'venta_id',
        'cli_id',
        'venta_fecha'
    ];
    public function cliente (){
        return $this->belongsTo('App\Models\Cliente','cli_id');
    }
}
