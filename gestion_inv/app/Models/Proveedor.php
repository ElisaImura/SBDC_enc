<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    public $table = 'proveedores';
     protected $fillable = [
        'prove_id',
        'prove_nombre',
        'prove_ruc'
    ];
}
