<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;
class Caso extends Model
{
    use HasFactory;
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
    protected $fillable = [
        'cliente_id',
        'codigo',
        'tipo',
        'fecha_inicio',
        'detalles',
 
    ];
    public function tareas()
{
    return $this->hasMany(\App\Models\Tarea::class);
}

}
