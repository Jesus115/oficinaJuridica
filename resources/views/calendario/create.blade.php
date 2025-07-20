@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Evento de Calendario</h2>

    <form method="POST" action="{{ route('calendario.store') }}">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título del Evento</label>
            <input type="text" name="titulo" class="form-control" required value="{{ old('titulo') }}">
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" name="fecha" class="form-control" required value="{{ old('fecha') }}">
        </div>

        <div class="mb-3">
            <label for="caso_id" class="form-label">Caso relacionado</label>
            <select name="caso_id" class="form-control" required>
                <option value="">-- Seleccione un caso --</option>
                @foreach($casos as $caso)
                    <option value="{{ $caso->id }}">{{ $caso->codigo }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Guardar Evento</button>
        <a href="{{ route('calendario.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
