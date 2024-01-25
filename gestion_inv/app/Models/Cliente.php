<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $primaryKey = 'cli_id';
     protected $fillable = [
        'cli_id',
        'cli_nombre',
        'cli_apellido',
        'cli_ruc',
        'cli_direccion',
        'cli_telefono'
    ];
}
