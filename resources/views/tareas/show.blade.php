@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle de Tarea</h2>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $tarea->titulo }}</h5>
            <p><strong>Asignado a:</strong> {{ $tarea->asignado->name ?? 'N/A' }}</p>
            <p><strong>Estado:</strong> {{ ucfirst($tarea->estado) }}</p>
            <p><strong>Prioridad:</strong> {{ ucfirst($tarea->prioridad) }}</p>
            <p><strong>Fecha límite:</strong> {{ $tarea->fecha_limite ? \Carbon\Carbon::parse($tarea->fecha_limite)->format('d/m/Y') : '-' }}</p>
            <p><strong>Descripción:</strong><br>{{ $tarea->descripcion }}</p>
        </div>
    </div>

    <h4>📎 Evidencias</h4>
    <ul>
        @forelse($tarea->evidencias as $ev)
            <li><a href="{{ asset('storage/' . $ev->archivo) }}" target="_blank">Archivo {{ $loop->iteration }}</a></li>
        @empty
            <li>No hay evidencias registradas.</li>
        @endforelse
    </ul>

    <form action="{{ route('tareas.subirEvidencia', [$tarea->caso_id, $tarea->id]) }}" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf
        <div class="mb-3">
            <label for="archivo" class="form-label">Subir nueva evidencia</label>
            <input type="file" name="archivo" class="form-control" required>
        </div>
        <button class="btn btn-success">Cargar</button>
    </form>

    <a href="{{ route('tareas.index', $tarea->caso_id) }}" class="btn btn-secondary mt-3">Volver</a>
</div>
@endsection
