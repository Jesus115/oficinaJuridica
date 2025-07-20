@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Evento</h2>

    <form method="POST" action="{{ route('calendario.update', $evento->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $evento->titulo) }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" name="fecha" class="form-control"
                value="{{ \Carbon\Carbon::parse($evento->fecha)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="caso_id" class="form-label">Caso</label>
            <select name="caso_id" class="form-control" required>
                @foreach($casos as $caso)
                    <option value="{{ $caso->id }}" {{ $caso->id == $evento->caso_id ? 'selected' : '' }}>
                        {{ $caso->codigo }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('calendario.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
