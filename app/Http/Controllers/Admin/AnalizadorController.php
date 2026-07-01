<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AnalizadorController extends Controller
{
    /**
     * Mostrar vista principal
     */
    public function index()
    {
        return view('admin.analizador');
    }

    /**
     * Procesar documento mediante Ollama
     */
    public function procesar(Request $request)
    {
        // Evitar timeout de PHP
        set_time_limit(0);
        ini_set('memory_limit', '1024M');

        $request->validate([
            'documento' => 'required|mimes:pdf,docx,txt|max:25600'
        ], [
            'documento.required' => 'Seleccione un documento.',
            'documento.mimes' => 'Solo se permiten archivos PDF, DOCX o TXT.',
            'documento.max' => 'El tamaño máximo permitido es de 25 MB.'
        ]);

        try {

            // ====================================================
            // DATOS DEL ARCHIVO
            // ====================================================

            $archivo = $request->file('documento');

            $rutaTemporal = $archivo->getRealPath();
            $nombreOriginal = $archivo->getClientOriginalName();
            $extension = strtolower($archivo->getClientOriginalExtension());

            // ====================================================
            // EXTRAER CONTENIDO
            // ====================================================

            $textoDocumento = '';

            switch ($extension) {

                case 'txt':
                    $textoDocumento = file_get_contents($rutaTemporal);
                    break;

                case 'pdf':
                    $textoDocumento = "Documento PDF recibido: {$nombreOriginal}";
                    break;

                case 'docx':
                    $textoDocumento = "Documento DOCX recibido: {$nombreOriginal}";
                    break;

                default:
                    throw new \Exception('Formato de archivo no soportado.');
            }

            if (empty(trim($textoDocumento))) {
                throw new \Exception('No se pudo obtener contenido del documento.');
            }

            // ====================================================
            // LIMITAR TEXTO PARA EVITAR SATURAR LLAMA3
            // ====================================================

            $textoDocumento = mb_substr($textoDocumento, 0, 15000);

            // ====================================================
            // PROMPT
            // ====================================================

            $prompt = "
Analiza el siguiente documento académico.

Genera un informe profesional con la siguiente estructura:

1. Resumen Ejecutivo
2. Objetivos Detectados
3. Temas Principales
4. Análisis Técnico
5. Conclusiones
6. Recomendaciones

Documento:

{$textoDocumento}
";

            // ====================================================
            // CONEXIÓN OLLAMA
            // ====================================================

            $ipVM = '192.168.135.28';

            $respuesta = Http::timeout(900)
                ->connectTimeout(30)
                ->retry(3, 5000)
                ->acceptJson()
                ->post("http://{$ipVM}:11434/api/generate", [
                    'model' => 'qwen:4b',
                    'prompt' => $prompt,
                    'stream' => false,
                    'options' => [
                        'temperature' => 0.3,
                        'top_p' => 0.9,
                        'num_predict' => 2000
                    ]
                ]);

            // ====================================================
            // VALIDAR RESPUESTA
            // ====================================================

            if (!$respuesta->successful()) {

                Log::error('Error Ollama', [
                    'status' => $respuesta->status(),
                    'body' => $respuesta->body()
                ]);

                throw new \Exception(
                    'Ollama respondió con error HTTP: ' .
                    $respuesta->status()
                );
            }

            $json = $respuesta->json();

            if (!isset($json['response'])) {
                throw new \Exception(
                    'Ollama no devolvió el campo response.'
                );
            }

            $resultadoIa = trim($json['response']);

            if (empty($resultadoIa)) {
                throw new \Exception(
                    'La respuesta generada por la IA está vacía.'
                );
            }

            // ====================================================
            // GUARDAR REPORTE
            // ====================================================

            $nombreReporte =
                'reporte_' .
                date('Ymd_His') .
                '_' .
                uniqid() .
                '.txt';

            Storage::disk('public')->put(
                $nombreReporte,
                $resultadoIa
            );

            $urlDescarga = Storage::url($nombreReporte);

            // ====================================================
            // RESPUESTA
            // ====================================================

            return back()->with([
                'archivoGeneradoUrl' => $urlDescarga,
                'ultimoArchivo' => $nombreOriginal,
                'mensajeExito' => 'Documento procesado correctamente.'
            ]);

        } catch (\Throwable $e) {

            Log::error('Error AnalizadorController', [
                'mensaje' => $e->getMessage(),
                'archivo' => $e->getFile(),
                'linea' => $e->getLine()
            ]);

            return back()->with(
                'mensajeError',
                'Ocurrió un error durante el procesamiento: ' .
                $e->getMessage()
            );
        }
    }
}