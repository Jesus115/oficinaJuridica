@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Cliente</h2>

    <form method="POST" action="{{ route('clientes.update', $cliente->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $cliente->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $cliente->email) }}" required>
        </div>
        <div class="mb-3">
            <label for="password">Nueva Contraseña (opcional)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label for="password_confirmation">Confirmar Nueva Contraseña</label>
            <input type="password" name="password_confirmation" class="form-control">
        </div>


        <button class="btn btn-primary">Actualizar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
