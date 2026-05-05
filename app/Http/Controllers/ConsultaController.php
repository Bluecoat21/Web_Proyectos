<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente; 
use App\Models\Servicio; 
use App\Models\Consulta;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cliente = Cliente::firstOrCreate(
        ["telefono" => $request->telefono],
        ["nombre" => $request->nombre, "email" =>$request->email]);
    $consulta = Consulta::create([
        "cliente_id" => $cliente->id,
        "servicio_id" => $request->servicio_id,
        "mensaje_cliente" => $request->mensaje]);
    $servicio = Servicio::find($request->servicio_id);
    $texto="Hola, soy {$cliente->nombre}. me interesa el servicio de: {$servicio->titulo}";
    $url = "https://wa.me/51913258623?text=" . urlencode($texto);
    
    return redirect()->away($url);
    }

    public function show(Consulta $consulta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consulta $consulta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consulta $consulta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consulta $consulta)
    {
        //
    }
}
