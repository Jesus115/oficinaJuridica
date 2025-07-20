@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle del Caso</h2>

    <div class="card">
        <div class="card-body">
            <h5><strong>Código:</strong> {{ $caso->codigo }}</h5>
            <p><strong>Cliente:</strong> {{ $caso->cliente->nombre ?? 'Sin cliente' }}</p>
            <p><strong>Tipo de Caso:</strong> {{ $caso->tipo }}</p>
            <p><strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($caso->fecha_inicio)->format('d/m/Y') }}</p>
            <p><strong>Detalles:</strong><br> {{ $caso->detalles }}</p>

            <a href="{{ route('casos.edit', $caso->id) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('casos.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
