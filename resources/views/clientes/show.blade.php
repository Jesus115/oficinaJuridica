@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalles del Cliente</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
            <p><strong>Email:</strong> {{ $cliente->email }}</p>

            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
