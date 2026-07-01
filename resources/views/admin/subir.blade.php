<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Trabajo - Admin Engine</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#0f172a] text-white flex flex-col min-h-screen">

    <!-- NAV INTEGRADO: Consistencia total con el módulo del analizador -->
    <nav class="bg-gray-900 border-b border-gray-800 px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-4 shrink-0">
        <div class="flex items-center gap-2">
            <span class="text-orange-500 font-black italic tracking-wider text-xl">PROYECTO -X</span>
            <span class="bg-orange-500/10 text-orange-400 text-xs px-2.5 py-1 rounded-md font-bold uppercase tracking-widest border border-orange-500/20">Admin Engine</span>
        </div>

        <div class="flex items-center gap-2 bg-[#0f172a] p-1 rounded-xl border border-gray-800">
            <a href="{{ route('admin.analizador.index') }}" 
               class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wide transition-all text-gray-400 hover:text-white">
                Analizador IA
            </a>
            <a href="{{ route('admin.subir') }}" 
               class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-wide transition-all bg-orange-500 text-white shadow-md">
                Subir Portafolio
            </a>
        </div>

        <div class="flex items-center gap-4">
            <div class="text-sm text-gray-400 hidden md:block">
                Módulo: <span class="text-white font-semibold">Gestor de Contenido</span>
            </div>
            <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="bg-red-600/10 hover:bg-red-600 text-red-400 hover:text-white border border-red-500/20 text-xs font-bold px-3 py-1.5 rounded-xl uppercase tracking-wider transition-all">
                    Salir
                </button>
            </form>
        </div>
    </nav>

    <!-- FORMULARIO ORIGINAL INTACTO -->
    <main class="flex-grow flex items-center justify-center py-12 px-6">
        <div class="max-w-2xl w-full bg-gray-900 p-8 rounded-3xl border border-gray-800">
            <h2 class="text-2xl font-bold mb-6 text-orange-500 uppercase italic">Subir Nuevo Trabajo</h2>
            
            <form action="{{ route('portafolio.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Título del Proyecto</label>
                    <input type="text" name="titulo" class="w-full bg-black border border-gray-800 rounded-xl p-3 text-white focus:border-orange-500 outline-none" required>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Imagen de Carátula (JPG/PNG)</label>
                    <input type="file" name="caratula" accept="image/*" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600" required>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Documento PDF</label>
                    <input type="file" name="pdf" accept="application/pdf" class="w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-700 file:text-white hover:file:bg-gray-600" required>
                </div>

                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-black py-4 rounded-xl transition-all">
                    PUBLICAR EN PORTAFOLIO
                </button>
            </form>
        </div>
    </main>

</body>
</html>