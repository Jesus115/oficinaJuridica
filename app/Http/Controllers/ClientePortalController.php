<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Caso;
use Illuminate\Support\Facades\Auth;
class ClientePortalController extends Controller
{
    public function index()
    {
        $cliente = Auth::guard('cliente')->user(); // o sesión personalizada
        $casos = Caso::where('cliente_id', $cliente->id)->get();

        return view('portal.index', compact('casos', 'cliente'));
    }

    /**
     * Mostrar los detalles de un caso si pertenece al cliente.
     */
    public function show($id)
    {
        
         $cliente = Auth::guard('cliente')->user();

        $caso = Caso::where('id', $id)
                    ->where('cliente_id', $cliente->id)
                    ->with(['tareas.evidencias', 'tareas.asignado'])
                    ->firstOrFail();

        return view('portal.show', compact('caso', 'cliente'));
    }
}
