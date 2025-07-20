<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Caso;
use App\Models\User;
use App\Models\Evidencia;
use Illuminate\Support\Facades\Storage;

class TareaController extends Controller
{
    public function index($caso_id)
    {
        $caso = Caso::findOrFail($caso_id);
        $tareas = Tarea::with('asignado')->where('caso_id', $caso_id)->get();

        return view('tareas.index', compact('tareas', 'caso'));
    }

    /**
     * Formulario para crear tarea.
     */
    public function create($caso_id)
    {
        $caso = Caso::findOrFail($caso_id);
        $usuarios = User::all();

        return view('tareas.create', compact('caso', 'usuarios'));
    }

    /**
     * Guardar tarea.
     */
    public function store(Request $request, $caso_id)
    {
        $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'prioridad'   => 'required|in:baja,media,alta',
            'estado'      => 'nullable|in:pendiente,en progreso,completado',
            'fecha_limite'=> 'nullable|date',
            'asignado_a'  => 'required|exists:users,id',
        ]);

        Tarea::create([
            'caso_id'      => $caso_id,
            'titulo'       => $request->titulo,
            'descripcion'  => $request->descripcion,
            'prioridad'    => $request->prioridad,
            'estado'       => $request->estado ?? 'pendiente',
            'fecha_limite' => $request->fecha_limite,
            'asignado_a'   => $request->asignado_a,
        ]);

        return redirect()->route('tareas.index', $caso_id)->with('success', 'Tarea registrada.');
    }

    /**
     * Ver detalles de una tarea.
     */
    public function show($caso_id, $id)
    {
        $tarea = Tarea::with('evidencias', 'asignado')->where('caso_id', $caso_id)->findOrFail($id);
        return view('tareas.show', compact('tarea'));
    }

    /**
     * Formulario de edición de tarea.
     */
    public function edit($caso_id, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $usuarios = User::all();

        return view('tareas.edit', compact('tarea', 'usuarios'));
    }

    /**
     * Actualizar tarea.
     */
    public function update(Request $request, $caso_id, $id)
    {
        $tarea = Tarea::findOrFail($id);

        $request->validate([
            'titulo'      => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'prioridad'   => 'required|in:baja,media,alta',
            'estado'      => 'required|in:pendiente,en progreso,completado',
            'fecha_limite'=> 'nullable|date',
            'asignado_a'  => 'required|exists:users,id',
        ]);

        $tarea->update($request->only([
            'titulo', 'descripcion', 'prioridad', 'estado', 'fecha_limite', 'asignado_a'
        ]));

        return redirect()->route('tareas.index', $caso_id)->with('success', 'Tarea actualizada.');
    }

    /**
     * Eliminar tarea.
     */
    public function destroy($caso_id, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();

        return redirect()->route('tareas.index', $caso_id)->with('success', 'Tarea eliminada.');
    }

    /**
     * Adjuntar evidencia a una tarea.
     */
    public function subirEvidencia(Request $request, $caso_id, $id)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:pdf,jpg,png,docx,zip|max:2048',
        ]);

        $tarea = Tarea::findOrFail($id);

        $path = $request->file('archivo')->store('evidencias', 'public');

        Evidencia::create([
            'tarea_id' => $tarea->id,
            'archivo'  => $path,
        ]);

        return back()->with('success', 'Evidencia cargada correctamente.');
    }
}
