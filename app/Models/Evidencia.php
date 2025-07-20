<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'tarea_id',
        'archivo',
        // agrega otros campos si los necesitas
    ];
//     
// 
}
