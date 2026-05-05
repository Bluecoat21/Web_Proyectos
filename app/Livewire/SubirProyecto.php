<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Trabajo;

class SubirProyecto extends Component
{
    use WithFileUploads; // Permite la carga de archivos

    public $titulo;
    public $caratula;
    public $pdf;

    public function save()
    {
        $this->validate([
            'titulo' => 'required',
            'caratula' => 'required|image|max:2048',
            'pdf' => 'required|mimes:pdf|max:12288', // 12MB Máx
        ]);

        // Guardar archivos en storage/app/public/
        $rutaImagen = $this->caratula->store('caratulas', 'public');
        $rutaPdf = $this->pdf->store('pdfs', 'public');

        // Crear registro en la BD
        Trabajo::create([
            'titulo' => $this->titulo,
            'caratula' => $rutaImagen,
            'pdf' => $rutaPdf,
        ]);

        session()->flash('success', 'Proyecto subido con éxito.');
        return redirect()->to('/portafolio');
    }

    public function render()
    {
        return view('livewire.subir_proyecto'); // Nombre de la vista abajo
    }
}