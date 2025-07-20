<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caso;
use App\Models\Cliente;
use Illuminate\Support\Str;
class CasoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $casos = Caso::with('cliente')->orderByDesc('created_at')->get();
        return view('casos.index', compact('casos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('casos.create', compact('clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id'   => 'required|exists:clientes,id',
            'tipo'         => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'detalles'     => 'nullable|string',
        ]);

        // Generar código único de caso
        $ultimoCasoId = Caso::max('id') + 1;
        $codigo = 'CASO-' . str_pad($ultimoCasoId, 4, '0', STR_PAD_LEFT);

        Caso::create([
            'cliente_id'   => $request->cliente_id,
            'codigo'       => $codigo,
            'tipo'         => $request->tipo,
            'fecha_inicio' => $request->fecha_inicio,
            'detalles'     => $request->detalles,
        ]);

        return redirect()->route('casos.index')->with('success', 'Caso creado exitosamente.');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $caso = Caso::findOrFail($id);
        $clientes = Cliente::all();
        return view('casos.edit', compact('caso', 'clientes'));
    }

    /**
     * Actualizar un caso.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'cliente_id'   => 'required|exists:clientes,id',
            'tipo'         => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'detalles'     => 'nullable|string',
        ]);

        $caso = Caso::findOrFail($id);
        $caso->update([
            'cliente_id'   => $request->cliente_id,
            'tipo'         => $request->tipo,
            'fecha_inicio' => $request->fecha_inicio,
            'detalles'     => $request->detalles,
        ]);

        return redirect()->route('casos.index')->with('success', 'Caso actualizado correctamente.');
    }

    /**
     * Eliminar un caso.
     */
    public function destroy($id)
    {
        $caso = Caso::findOrFail($id);
        $caso->delete();

        return redirect()->route('casos.index')->with('success', 'Caso eliminado.');
    }
}
