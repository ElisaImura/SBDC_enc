<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model implements Authenticatable
{
    use AuthenticableTrait;

    protected $table = 'usuarios'; // Nombre de tu tabla
    protected $primaryKey = 'usu_id'; // Nombre de tu clave primaria
    protected $fillable = [
        'usu_nombre',
        'usu_contra',
    ];

    // Resto del modelo...
}

