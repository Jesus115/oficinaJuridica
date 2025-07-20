@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ingreso de Usuario Interno</h2>

    <form method="POST" action="{{ route('user.login.submit') }}">
        @csrf

        <div class="mb-3">
            <label>Correo</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary">Iniciar Sesión</button>
    </form>
</div>
@endsection
