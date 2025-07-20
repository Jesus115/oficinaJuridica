
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Calendario de Eventos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('calendario.create') }}" class="btn btn-primary mb-3">Crear Nuevo Evento</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Título</th>
                <th>Fecha</th>
                <th>Caso</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventos as $evento)
                <tr>
                    <td>{{ $evento->titulo }}</td>
                    <td>{{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y H:i') }}</td>
                    <td>{{ $evento->caso->codigo ?? 'Sin código' }}</td>
                    <td>
                        <a href="{{ route('calendario.show', $evento->id) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('calendario.edit', $evento->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('calendario.destroy', $evento->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este evento?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
