@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Tarea: {{ $tarea->titulo }}</h2>

    <form method="POST" action="{{ route('tareas.update', [$tarea->caso_id, $tarea->id]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $tarea->titulo) }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ old('descripcion', $tarea->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="prioridad" class="form-label">Prioridad</label>
            <select name="prioridad" class="form-control" required>
                @foreach(['baja', 'media', 'alta'] as $prioridad)
                    <option value="{{ $prioridad }}" {{ $tarea->prioridad == $prioridad ? 'selected' : '' }}>
                        {{ ucfirst($prioridad) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" class="form-control" required>
                @foreach(['pendiente', 'en progreso', 'completado'] as $estado)
                    <option value="{{ $estado }}" {{ $tarea->estado == $estado ? 'selected' : '' }}>
                        {{ ucfirst($estado) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_limite" class="form-label">Fecha Límite</label>
            <input type="date" name="fecha_limite" class="form-control" value="{{ $tarea->fecha_limite }}">
        </div>

        <div class="mb-3">
            <label for="asignado_a" class="form-label">Asignado a</label>
            <select name="asignado_a" class="form-control" required>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ $usuario->id == $tarea->asignado_a ? 'selected' : '' }}>
                        {{ $usuario->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('tareas.index', $tarea->caso_id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
