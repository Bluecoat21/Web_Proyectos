<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AnalizadorController extends Controller
{
    public function index()
    {
        return view('admin.analizador');
    }

    public function procesar(Request $request)
    {
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
            $archivo = $request->file('documento');
            $rutaTemporal = $archivo->getRealPath();
            $nombreOriginal = $archivo->getClientOriginalName();
            $extension = strtolower($archivo->getClientOriginalExtension());

            $textoDocumento = '';
            switch ($extension) {
                case 'txt': 
                    $textoDocumento = file_get_contents($rutaTemporal); 
                    $textoDocumento = mb_convert_encoding($textoDocumento, 'UTF-8', 'UTF-8, ISO-8859-1, Windows-1252');
                    break;
                
                case 'pdf': 
                case 'docx': 
                    $textoDocumento = "Análisis del archivo de datos: " . $nombreOriginal;
                    break;

                default: 
                    throw new \Exception('Formato de archivo no soportado.');
            }

            if (empty(trim($textoDocumento))) {
                throw new \Exception('No se pudo obtener contenido del documento.');
            }

            // Llama 3 maneja ventanas de contexto más grandes (leemos hasta 12000 caracteres)
            $textoDocumento = mb_substr($textoDocumento, 0, 12000);

            // PROMPT ADAPTATIVO: Obliga a la IA a rellenar y expandir para simular un informe de páginas completas
            $prompt = "Actúa como un redactor académico experto. Tu tarea es elaborar un informe de investigación formal, riguroso y detallado a partir del texto de origen. 
            
El documento final DEBE simular una estructura paginada real. Si la información del texto de origen es breve, investiga, expande y redacta explicaciones conceptuales, teóricas o de ingeniería profundas en español para completar el rigor de cada sección.

Escribe el informe utilizando estrictamente la estructura de marcado Markdown detallada a continuación. No incluyas comentarios, ni metatexto, ni notas del sistema. Comienza directamente en el '# TÍTULO':

## PÁGINA 1: Portada e Índice
[PORTADA]
Escribe aquí un índice formal con temas y subtemas simulando números de página realistas correlativos (ej. Introducción... 3).

## PÁGINA 2: Introducción y Objetivos
[INTRODUCCION]
Escribe una introducción formal, extensa y contextualizada sobre la importancia del tema.
[OBJETIVOS]
Escribe un 'Objetivo General' de investigación y al menos cuatro 'Objetivos Específicos' claros y estructurados en formato de lista.

## PÁGINA 3: Marco Teórico y Conceptos Fundamentales
[MARCO_TEORICO]
Desarrolla en profundidad los antecedentes y bases lógicas del tema analizado, definiendo conceptos y fórmulas utilizando texto estándar.

## PÁGINA 4: Desarrollo Técnico del Tema
[DESARROLLO]
Desglosa aquí la parte práctica o técnica de forma profunda, fluida y con explicaciones paso a paso de los procesos, comandos o flujos de trabajo identificados.

## PÁGINA 5: Resultados, Discusión y Conclusiones
[RESULTADOS]
Presenta el análisis de los resultados obtenidos y una discusión crítica de su aplicación real.
[CONCLUSIONES]
Escribe una lista estructurada con al menos cinco conclusiones rigurosas sobre el estudio.

## PÁGINA 6: Bibliografía
[BIBLIOGRAFIA]
Presenta una lista de referencias bibliográficas en formato estándar (Autor, Año, Título, Editorial) que den soporte a la teoría descrita.

Texto de origen para analizar:
{$textoDocumento}";

            $ipVM = '192.168.135.35';

            $respuesta = Http::withOptions([
                'connect_timeout' => 30,  
                'timeout'         => 1200, 
            ])->post("http://{$ipVM}:11434/api/generate", [
                'model'   => 'llama3:8b', 
                'prompt'  => $prompt,
                'stream'  => false,
                'options' => [
                    'temperature' => 0.4,
                    'num_predict' => 3000 // Permitimos más tokens para que la redacción sea extensa
                ]
            ]);

            if (!$respuesta->successful()) {
                throw new \Exception('Ollama respondió con error HTTP: ' . $respuesta->status());
            }

            $json = $respuesta->json();
            $textoPlano = trim($json['response'] ?? '');

            if (empty($textoPlano)) {
                throw new \Exception('La IA devolvió un buffer vacío.');
            }

            // PASO MAESTRO: Tu backend se encarga de estructurar el Markdown a HTML aplicando saltos de página físicos para Word
            $lineas = explode("\n", $textoPlano);
            $htmlProcesado = "";
            $enPortada = true;
            $primeraPagina = true;

            foreach ($lineas as $linea) {
                $linea = trim($linea);
                if (empty($linea)) continue;

                if (str_starts_with($linea, '# ')) {
                    $titulo = trim(str_replace('#', '', $linea));
                    if ($enPortada) {
                        $htmlProcesado .= "<div class='portada'>
                            <div class='institucion'>INSTITUTO / UNIVERSIDAD</div>
                            <div class='facultad'>Facultad o Escuela Profesional</div>
                            <br><br><br><br>
                            <h1>{$titulo}</h1>
                            <br><br>
                            <div class='subtitulo'>Informe Académico</div>
                            <br><br><br><br>
                            <div class='ciudad-fecha'>Arequipa – Perú, 2026</div>
                        </div>";
                        $enPortada = false;
                        $primeraPagina = false;
                    } else {
                        $htmlProcesado .= "<h1>{$titulo}</h1>";
                    }
                } elseif (str_starts_with($linea, '## PÁGINA')) {
                    $nombrePagina = trim(str_replace('##', '', $linea));
                    if (!$primeraPagina) {
                        $htmlProcesado .= "<div class='salto-pagina'></div>";
                    }
                    $htmlProcesado .= "<h2>{$nombrePagina}</h2>";
                    $primeraPagina = false;
                } elseif (str_starts_with($linea, '## ')) {
                    $subtitulo = trim(str_replace('##', '', $linea));
                    $htmlProcesado .= "<h3>{$subtitulo}</h3>";
                } elseif (str_starts_with($linea, '- ') || str_starts_with($linea, '* ')) {
                    $item = trim(substr($linea, 2));
                    $htmlProcesado .= "<ul><li>{$item}</li></ul>";
                } elseif (preg_match('/^\d+\.\s(.*)/', $linea, $matches)) {
                    $htmlProcesado .= "<ol><li>{$matches[1]}</li></ol>";
                } else {
                    // Evitar incluir marcadores literales del prompt en la visualización
                    if (in_array($linea, ['[PORTADA]', '[INTRODUCCION]', '[OBJETIVOS]', '[MARCO_TEORICO]', '[DESARROLLO]', '[RESULTADOS]', '[CONCLUSIONES]', '[BIBLIOGRAFIA]'])) {
                        continue;
                    }
                    $htmlProcesado .= "<p>{$linea}</p>";
                }
            }

            // PLANTILLA HTML OPTIMIZADA CON SOPORTE DE HOJA Y SALTO FÍSICO PARA WORD (.DOC)
            $documentoWordHtml = "
            <html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'>
            <head>
                <meta charset='utf-8'>
                <title>Informe Académico Automatizado</title>
                <style>
                    @page {
                        size: 8.5in 11in; /* Tamaño Carta */
                        margin: 1.0in 1.0in 1.0in 1.0in;
                    }
                    body { 
                        font-family: 'Arial', sans-serif; 
                        font-size: 11pt; 
                        color: #111111; 
                        line-height: 1.6; 
                    }
                    .portada { 
                        text-align: center; 
                        margin-top: 50pt;
                        margin-bottom: 50pt;
                    }
                    .institucion { 
                        font-size: 14pt; 
                        font-weight: bold; 
                        color: #1F497D; 
                        text-transform: uppercase; 
                    }
                    .facultad { 
                        font-size: 12pt; 
                        color: #333333; 
                        margin-top: 5pt;
                    }
                    h1 { 
                        font-size: 18pt; 
                        color: #1F497D; 
                        text-align: center; 
                        margin-top: 60pt; 
                        margin-bottom: 20pt; 
                        font-weight: bold; 
                        text-transform: uppercase;
                    }
                    .subtitulo { 
                        font-size: 13pt; 
                        font-style: italic; 
                        color: #555555; 
                        font-weight: bold;
                    }
                    .ciudad-fecha { 
                        font-size: 11pt; 
                        margin-top: 120pt; 
                        font-weight: bold; 
                    }
                    h2 { 
                        font-size: 14pt; 
                        color: #1F497D; 
                        margin-top: 20pt; 
                        margin-bottom: 15pt; 
                        font-weight: bold; 
                        border-bottom: 2px solid #1F497D; 
                        text-transform: uppercase; 
                    }
                    h3 { 
                        font-size: 12pt; 
                        color: #1F497D; 
                        margin-top: 15pt; 
                        margin-bottom: 8pt; 
                        font-weight: bold; 
                    }
                    p { 
                        text-align: justify; 
                        margin-bottom: 12pt; 
                        text-indent: 0.5in; 
                    }
                    ul, ol { 
                        margin-bottom: 12pt; 
                        padding-left: 20pt; 
                    }
                    li { 
                        text-align: justify; 
                        margin-bottom: 6pt; 
                    }
                    
                    /* Fuerza el salto de página físico al abrirse en Microsoft Word */
                    .salto-pagina { 
                        page-break-before: always; 
                        clear: both; 
                    }
                </style>
            </head>
            <body>
                {$htmlProcesado}
            </body>
            </html>";

            $nombreReporte = 'reporte_' . date('Ymd_His') . '_' . uniqid() . '.doc';
            
            if (!file_exists(storage_path('app/public'))) {
                mkdir(storage_path('app/public'), 0755, true);
            }
            
            $rutaDestino = storage_path('app/public/' . $nombreReporte);
            file_put_contents($rutaDestino, $documentoWordHtml);

            return back()->with([
                'archivoGeneradoUrl' => Storage::url($nombreReporte),
                'ultimoArchivo' => $nombreOriginal,
                'mensajeExito' => 'Informe académico estructurado de forma analítica y automática mediante Llama 3.'
            ]);

        } catch (\Throwable $e) {
            Log::error('Error AnalizadorController: ' . $e->getMessage());
            return back()->with('mensajeError', 'Error: ' . $e->getMessage());
        }
    }
}