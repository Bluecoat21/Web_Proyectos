<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajo; // Asegúrate de usar el modelo correcto[cite: 2]

class PortafolioController extends Controller
{
    public function index()
    {
        $trabajos = Trabajo::all();
        return view('portafolio', compact('trabajos'));
    }

    public function store(Request $request)
    {
        // 1. Validar datos
        $request->validate([
            'titulo' => 'required',
            'caratula' => 'required|image|max:2048',
            'pdf' => 'required|mimes:pdf|max:10000'
        ]);

        // 2. Guardar archivos físicamente y obtener la ruta
        // Esto se guarda en storage/app/public/
        $rutaImagen = $request->file('caratula')->store('caratulas', 'public');
        $rutaPdf = $request->file('pdf')->store('pdfs', 'public');

        // 3. Guardar en la base de datos usando las columnas de tu imagen
        Trabajo::create([
            'titulo' => $request->titulo,
            'caratula' => $rutaImagen, 
            'pdf' => $rutaPdf
        ]);

        return redirect()->route('portafolio.index')->with('success', '¡Proyecto publicado!');
    }
}