@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle del Evento</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $evento->titulo }}</h5>
            <p class="card-text">
                <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y H:i') }}<br>
                <strong>Caso:</strong> {{ $evento->caso->codigo ?? 'No asignado' }}
            </p>
            <a href="{{ route('calendario.edit', $evento->id) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('calendario.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
