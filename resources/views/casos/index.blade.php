@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lista de Casos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('casos.create') }}" class="btn btn-primary mb-3">Crear Nuevo Caso</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código</th>
                <th>Cliente</th>
                <th>Tipo</th>
                <th>Fecha de Inicio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($casos as $caso)
                <tr>
                    <td>{{ $caso->codigo }}</td>
                    <td>{{ $caso->cliente->nombre ?? 'Sin cliente' }}</td>
                    <td>{{ $caso->tipo }}</td>
                    <td>{{ \Carbon\Carbon::parse($caso->fecha_inicio)->format('d/m/Y') }}</td>
                    <td>
                        <!-- <a href="{{ route('casos.show', $caso->id) }}" class="btn btn-sm btn-info">Ver</a> -->
                        <a href="{{ route('casos.edit', $caso->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('casos.destroy', $caso->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este caso?')">Eliminar</button>
                        </form>
                    <a href="{{ route('tareas.index', ['caso' => $caso->id]) }}" class="btn btn-sm btn-success">Ver Tareas</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
