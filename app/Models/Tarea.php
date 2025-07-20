<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Caso;
use App\Models\Evidencia;
use App\Models\User;
class Tarea extends Model
{
    use HasFactory;
    protected $fillable = [
        'caso_id',
        'asignado_a',
        'titulo',
        'descripcion',
        'prioridad',
        'estado',
        'fecha_limite'
    ];
    public function caso() {
        return $this->belongsTo(Caso::class);
    }

    public function asignado() {
        return $this->belongsTo(User::class, 'asignado_a');
    }

    public function evidencias() {
        return $this->hasMany(Evidencia::class);
    }
}






