<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analizador Académico IA - Admin</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-card-admin { background-color: #1e293b; }
        .drag-zone:hover { border-color: #f97316; background-color: rgba(249, 115, 22, 0.03); }
        /* Evita que el cargador parpadee antes de que Alpine cargue */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#0f172a] text-gray-100 selection:bg-orange-500 selection:text-white">

    <div class="min-h-screen flex flex-col" 
         x-data="{ 
            cargando: false, 
            dragging: false,
            porcentaje: 0,
            mensajeProgreso: 'Subiendo archivo...',
            intervalo: null,
            iniciarProgreso() {
                this.cargando = true;
                this.porcentaje = 0;
                this.mensajeProgreso = 'Enviando documento a la VM Linux...';
                
                // Simulación del progreso adaptado al tiempo de Llama 3
                this.intervalo = setInterval(() => {
                    if (this.porcentaje < 30) {
                        this.porcentaje += 5; // Sube rápido al inicio (Subida de datos)
                        this.mensajeProgreso = 'Conectando con Llama 3...';
                    } else if (this.porcentaje < 75) {
                        this.porcentaje += 1; // Ritmo normal (IA procesando fragmentos)
                        this.mensajeProgreso = 'La IA está analizando la redacción académica...';
                    } else if (this.porcentaje < 98) {
                        // Se ralentiza al final para aguantar los minutos de procesamiento de la VM
                        if (Math.random() > 0.5) {
                            this.porcentaje += 1;
                        }
                        this.mensajeProgreso = 'Redactando reporte final de auditoría...';
                    }
                }, 600);
            }
         }">
        
        <!-- NAV MODIFICADO: Sistema de pestañas y Control de sesión administrativa -->
        <nav class="bg-gray-900 border-b border-gray-800 px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-4 shrink-0">
            <div class="flex items-center gap-2">
                <span class="text-orange-500 font-black italic tracking-wider text-xl">PROYECTO -X</span>
                <span class="bg-orange-500/10 text-orange-400 text-xs px-2.5 py-1 rounded-md font-bold uppercase tracking-widest border border-orange-500/20">Admin Engine</span>
            </div>

            <div class="flex items-center gap-2 bg-[#0f172a] p-1 rounded-xl border border-gray-800">
                <a href="{{ route('admin.analizador.index') }}" 
                   class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wide transition-all bg-orange-500 text-white shadow-md">
                    Analizador IA
                </a>
                <a href="{{ route('admin.subir') }}" 
                   class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wide transition-all text-gray-400 hover:text-white">
                    Subir Portafolio
                </a>
            </div>

            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-400 hidden md:block">
                    Servicio: <span class="text-white font-semibold">Auditoría IA (Llama 3)</span>
                </div>
                <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-600/10 hover:bg-red-600 text-red-400 hover:text-white border border-red-500/20 text-xs font-bold px-3 py-1.5 rounded-xl uppercase tracking-wider transition-all">
                        Salir
                    </button>
                </form>
            </div>
        </nav>

        <main class="max-w-4xl mx-auto w-full py-12 px-6 flex-grow flex flex-col justify-center">
            
            <div class="bg-card-admin p-8 rounded-3xl shadow-2xl border border-gray-800 space-y-8 relative overflow-hidden min-h-[420px] flex flex-col justify-center">
                
                <div x-show="cargando" 
                     x-cloak
                     class="absolute inset-0 z-50 bg-[#1e293b] flex flex-col items-center justify-center space-y-6 p-8 text-center">
                    
                    <div class="relative flex items-center justify-center">
                        <svg class="w-32 h-32 transform -rotate-90">
                            <circle cx="64" cy="64" r="56" stroke="#2d3748" stroke-width="8" fill="transparent" />
                            <circle cx="64" cy="64" r="56" stroke="#f97316" stroke-width="8" fill="transparent"
                                    :stroke-dasharray="2 * Math.PI * 56"
                                    :stroke-dashoffset="2 * Math.PI * 56 * (1 - porcentaje / 100)"
                                    class="transition-all duration-300 ease-out" />
                        </svg>
                        <div class="absolute text-3xl font-black text-white tracking-tighter">
                            <span x-text="porcentaje"></span>%
                        </div>
                    </div>

                    <div class="space-y-3 w-full max-w-md">
                        <h3 class="text-lg font-bold text-white uppercase tracking-wide transition-all" x-text="mensajeProgreso"></h3>
                        
                        <div class="w-full h-2 bg-gray-800 rounded-full overflow-hidden relative">
                            <div class="bg-orange-500 h-full transition-all duration-300 ease-out" :style="`width: ${porcentaje}%`"></div>
                        </div>
                        <p class="text-[11px] text-gray-500 italic">Por favor, mantén esta ventana abierta mientras la IA procesa la información en la VM.</p>
                    </div>
                </div>

                <div x-show="!cargando">
                    
                    <div class="text-center space-y-2 mb-8">
                        <h2 class="text-2xl font-black text-white uppercase tracking-tight">Convertidor Académico Inteligente</h2>
                        <p class="text-gray-400 text-xs max-w-md mx-auto leading-relaxed">
                            Sube el archivo de tu cliente. La IA local lo procesará de inmediato y te entregará el reporte de auditoría corregido.
                        </p>
                    </div>

                    <form action="{{ route('admin.analizador.procesar') }}" 
                          method="POST" 
                          enctype="multipart/form-data"
                          x-ref="form"
                          @submit="iniciarProgreso()">
                        @csrf
                        
                        <div @dragover.prevent="dragging = true" 
                             @dragleave.prevent="dragging = false"
                             @drop="dragging = false"
                             :class="{ 'border-orange-500 bg-orange-500/5 shadow-[0_0_20px_rgba(249,115,22,0.1)]': dragging }"
                             class="relative rounded-2xl border-2 border-dashed border-gray-600 p-12 text-center transition-all duration-300 group drag-zone mb-6">
                            
                            <input type="file" 
                                   name="documento" 
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" 
                                   @change="if($el.files.length > 0) { iniciarProgreso(); $refs.form.submit(); }" />

                            <div class="space-y-4 pointer-events-none">
                                <div class="mx-auto w-16 h-16 rounded-2xl bg-gray-900 flex items-center justify-center text-gray-500 border border-gray-800 group-hover:text-orange-500 group-hover:border-orange-500/50 transition-all duration-300">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                </div>
                                
                                <div class="text-base">
                                    <span class="text-orange-500 font-bold">Haz clic para subir</span> o arrastra el archivo aquí
                                </div>
                                
                                <p class="text-xs text-gray-500 uppercase tracking-widest font-semibold">PDF, DOCX o TXT ( can max 25MB )</p>
                            </div>
                        </div>
                    </form>

                    @if($errors->any() || session('mensajeError') || session('error'))
                        <div class="bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-bold p-4 rounded-xl flex items-center gap-3 mb-6 animate-[fadeIn_0.3s_ease-out]">
                            <svg class="w-5 h-5 shrink-0 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            
                            <span>
                                @if($errors->any())
                                    {{ $errors->first() }}
                                @elseif(session('mensajeError'))
                                    {{ session('mensajeError') }}
                                @else
                                    {{ session('error') }}
                                @endif
                            </span>
                        </div>
                    @endif

                    @if(session('archivoGeneradoUrl'))
                        <div class="bg-emerald-500/5 border border-emerald-500/20 rounded-2xl p-6 flex flex-col sm:flex-row items-center justify-between gap-6 animate-[fadeIn_0.5s_ease-out]">
                            <div class="flex items-center gap-4 text-center sm:text-left">
                                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 flex items-center justify-center text-emerald-400 shrink-0 shadow-[0_0_15px_rgba(16,185,129,0.1)]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-white uppercase tracking-tight">¡Auditoría Listo!</h4>
                                    <p class="text-xs text-gray-400">El archivo ha sido procesado por Llama 3 exitosamente.</p>
                                    @if(session('ultimoArchivo'))
                                        <p class="text-[10px] text-emerald-500 font-mono mt-1">Ref: {{ session('ultimoArchivo') }}</p>
                                    @endif
                                </div>
                            </div>
                            
                            <a href="{{ session('archivoGeneradoUrl') }}" download class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black px-8 py-4 rounded-xl uppercase tracking-widest shadow-lg transition-all duration-200 active:scale-95 text-center">
                                Descargar Reporte
                            </a>
                        </div>
                    @endif

                </div> 
            </div>

            <p class="mt-8 text-center text-gray-600 text-[10px] uppercase tracking-[0.2em] font-bold">
                Motor de Inteligencia Artificial Local • Basado en Llama 3
            </p>
        </main>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>