@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tareas del Caso: {{ $caso->codigo }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('tareas.create', $caso->id) }}" class="btn btn-primary mb-3">Nueva Tarea</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Asignado</th>
                <th>Prioridad</th>
                <th>Estado</th>
                <th>Fecha límite</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tareas as $tarea)
                <tr>
                    <td>{{ $tarea->titulo }}</td>
                    <td>{{ $tarea->asignado->name ?? 'N/A' }}</td>
                    <td>{{ ucfirst($tarea->prioridad) }}</td>
                    <td>{{ ucfirst($tarea->estado) }}</td>
                    <td>{{ $tarea->fecha_limite ? \Carbon\Carbon::parse($tarea->fecha_limite)->format('d/m/Y') : '-' }}</td>
                    <td>
                        <a href="{{ route('tareas.show', [$caso->id, $tarea->id]) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('tareas.edit', [$caso->id, $tarea->id]) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('tareas.destroy', [$caso->id, $tarea->id]) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta tarea?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
