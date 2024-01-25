<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedores';
    protected $primaryKey = 'prove_id';
    protected $fillable = [
        'prove_id',
        'prove_nombre',
        'prove_ruc'
    ];
}

