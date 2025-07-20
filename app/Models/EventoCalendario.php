<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Caso;
class EventoCalendario extends Model
{
    use HasFactory;
    protected $table = 'eventos_calendario';
    public function caso()
    {
        return $this->belongsTo(Caso::class);
    }
    protected $fillable = [
        'caso_id',
        'titulo',
        'fecha',
        // agrega otros campos si los necesitas
    ];
}


