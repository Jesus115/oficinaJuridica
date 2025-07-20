<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;
class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Formulario para crear un nuevo cliente.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Guardar cliente nuevo en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:clientes,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        Cliente::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Ver detalles de un cliente.
     */
    public function show($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Formulario para editar cliente.
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Actualizar cliente existente.
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:clientes,email,' . $cliente->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $cliente->nombre = $request->nombre;
        $cliente->email = $request->email;

        if ($request->filled('password')) {
            $cliente->password = Hash::make($request->password);
        }

        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    /**
     * Eliminar cliente.
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado.');
    }
}
