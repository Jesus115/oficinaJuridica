@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Crear Nuevo Caso</h2>

    <form method="POST" action="{{ route('casos.store') }}">
        @csrf

        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" class="form-control" required>
                <option value="">-- Seleccione un cliente --</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo de Caso</label>
            <input type="text" name="tipo" class="form-control" value="{{ old('tipo') }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
        </div>

        <div class="mb-3">
            <label for="detalles" class="form-label">Detalles</label>
            <textarea name="detalles" class="form-control">{{ old('detalles') }}</textarea>
        </div>

        <button class="btn btn-success">Guardar Caso</button>
        <a href="{{ route('casos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
