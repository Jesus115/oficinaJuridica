@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Detalle del Usuario</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $usuario->name }}</p>
            <p><strong>Email:</strong> {{ $usuario->email }}</p>

            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection
