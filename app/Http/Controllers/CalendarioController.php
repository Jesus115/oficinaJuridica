<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EventoCalendario;
use App\Models\Caso;
use Illuminate\Support\Facades\Validator;

class CalendarioController extends Controller
{
    
        /**
     * Mostrar todos los eventos del calendario (vista general).
     */
    public function index()
    {
        $eventos = EventoCalendario::with('caso')->orderBy('fecha', 'asc')->get();
        return view('calendario.index', compact('eventos'));
    }

    /**
     * Mostrar formulario para crear un nuevo evento.
     */
    public function create()
    {
        $casos = Caso::all(); // Para seleccionar a qué caso pertenece
        return view('calendario.create', compact('casos'));
    }

    /**
     * Guardar un nuevo evento en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'   => 'required|string|max:255',
            'fecha'    => 'required|date|after_or_equal:today',
            'caso_id'  => 'required|exists:casos,id',
        ]);

        EventoCalendario::create($request->only(['titulo', 'fecha', 'caso_id']));

        return redirect()->route('calendario.index')->with('success', 'Evento creado correctamente.');
    }

    /**
     * Mostrar un evento específico.
     */
    public function show($id)
    {
        $evento = EventoCalendario::with('caso')->findOrFail($id);
        return view('calendario.show', compact('evento'));
    }

    /**
     * Mostrar formulario para editar un evento.
     */
    public function edit($id)
    {
        $evento = EventoCalendario::findOrFail($id);
        $casos = Caso::all();
        return view('calendario.edit', compact('evento', 'casos'));
    }

    /**
     * Actualizar un evento existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo'   => 'required|string|max:255',
            'fecha'    => 'required|date|after_or_equal:today',
            'caso_id'  => 'required|exists:casos,id',
        ]);

        $evento = EventoCalendario::findOrFail($id);
        $evento->update($request->only(['titulo', 'fecha', 'caso_id']));

        return redirect()->route('calendario.index')->with('success', 'Evento actualizado correctamente.');
    }

    /**
     * Eliminar un evento del calendario.
     */
    public function destroy($id)
    {
        $evento = EventoCalendario::findOrFail($id);
        $evento->delete();

        return redirect()->route('calendario.index')->with('success', 'Evento eliminado correctamente.');
    }
}
