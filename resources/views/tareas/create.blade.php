@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Nueva Tarea para el Caso: {{ $caso->codigo }}</h2>

    <form method="POST" action="{{ route('tareas.store', $caso->id) }}">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="prioridad" class="form-label">Prioridad</label>
            <select name="prioridad" class="form-control" required>
                <option value="baja">Baja</option>
                <option value="media">Media</option>
                <option value="alta">Alta</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_limite" class="form-label">Fecha Límite</label>
            <input type="date" name="fecha_limite" class="form-control">
        </div>

        <div class="mb-3">
            <label for="asignado_a" class="form-label">Asignar a</label>
            <select name="asignado_a" class="form-control" required>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Crear</button>
        <a href="{{ route('tareas.index', $caso->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
