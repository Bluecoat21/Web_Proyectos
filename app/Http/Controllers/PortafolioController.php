<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trabajo; // O el nombre exacto de tu Modelo (ej. Proyecto)
use Illuminate\Support\Facades\Storage;

class PortafolioController extends Controller
{
    public function index()
    {
        $trabajos = Trabajo::all();
        return view('portafolio', compact('trabajos'));
    }

    // Nueva vista administrativa que lista y tiene el formulario de subida
    public function adminIndex()
    {
        $trabajos = Trabajo::orderBy('id', 'desc')->get();
        return view('admin.subir', compact('trabajos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'caratula' => 'required|image|max:2048',
            'pdf' => 'required|mimes:pdf|max:25600'
        ]);

        $rutaImagen = $request->file('caratula')->store('caratulas', 'public');
        $rutaPdf = $request->file('pdf')->store('pdfs', 'public');

        Trabajo::create([
            'titulo' => $request->titulo,
            'caratula' => $rutaImagen, 
            'pdf' => $rutaPdf
        ]);

        return redirect()->route('admin.subir')->with('success', '¡Proyecto publicado con éxito!');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $trabajo = Trabajo::findOrFail($id);
        return view('admin.editar_portafolio', compact('trabajo'));
    }

    // Procesar la actualización
    public function update(Request $request, $id)
    {
        $trabajo = Trabajo::findOrFail($id);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'caratula' => 'nullable|image|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:25600'
        ]);

        $trabajo->titulo = $request->titulo;

        // Si se sube una nueva carátula, eliminar la anterior y guardar la nueva
        if ($request->hasFile('caratula')) {
            Storage::disk('public')->delete($trabajo->caratula);
            $trabajo->caratula = $request->file('caratula')->store('caratulas', 'public');
        }

        // Si se sube un nuevo PDF, eliminar el anterior y guardar el nuevo
        if ($request->hasFile('pdf')) {
            Storage::disk('public')->delete($trabajo->pdf);
            $trabajo->pdf = $request->file('pdf')->store('pdfs', 'public');
        }

        $trabajo->save();

        return redirect()->route('admin.subir')->with('success', 'Proyecto actualizado correctamente.');
    }

    // Eliminar el registro y sus archivos físicos
    public function destroy($id)
    {
        $trabajo = Trabajo::findOrFail($id);

        // Eliminar archivos físicos de Storage
        Storage::disk('public')->delete($trabajo->caratula);
        Storage::disk('public')->delete($trabajo->pdf);

        // Eliminar de la base de datos
        $trabajo->delete();

        return redirect()->route('admin.subir')->with('success', 'Proyecto eliminado del portafolio.');
    }
}