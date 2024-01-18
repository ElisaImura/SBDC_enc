<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    public $table = 'usuarios';
     protected $fillable = [
        'usu_id',
        'usu_nombre',
        'usu_contra'
    ];
}
