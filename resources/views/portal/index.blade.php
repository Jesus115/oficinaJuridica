@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Mis Casos</h2>

    <p><strong>Bienvenido, {{ $cliente->nombre }}</strong></p>

    @if($casos->isEmpty())
        <p>No tienes casos registrados.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Tipo</th>
                    <th>Fecha de Inicio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($casos as $caso)
                    <tr>
                        <td>{{ $caso->codigo }}</td>
                        <td>{{ $caso->tipo }}</td>
                        <td>{{ \Carbon\Carbon::parse($caso->fecha_inicio)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('portal.show', $caso->id) }}" class="btn btn-info btn-sm">Ver Detalle</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
