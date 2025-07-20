@extends('layouts.app')

@section('content')
<hr>
<h4>📋 Tareas Asociadas</h4>

@if($caso->tareas->isEmpty())
    <p>No hay tareas registradas para este caso.</p>
@else
    <ul>
        @foreach($caso->tareas as $tarea)
            <li>
                <strong>{{ $tarea->titulo }}</strong> ({{ ucfirst($tarea->estado) }})<br>
                <em>Asignado a:</em> {{ $tarea->asignado->name ?? 'N/A' }}<br>
                <em>Prioridad:</em> {{ ucfirst($tarea->prioridad) }}<br>
                <em>Fecha límite:</em> {{ $tarea->fecha_limite ?? 'Sin definir' }}

                @if($tarea->evidencias->isNotEmpty())
                    <ul>
                        @foreach($tarea->evidencias as $evidencia)
                            <li><a href="{{ asset('storage/' . $evidencia->archivo) }}" target="_blank">📎 Evidencia</a></li>
                        @endforeach
                    </ul>
                @endif
            </li>
            <hr>
        @endforeach
    </ul>
@endif
@endsection

