<!DOCTYPE html>
<html lang="es">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0f172a] text-white p-10">
    <div class="max-w-2xl mx-auto bg-gray-900 p-8 rounded-3xl border border-gray-800">
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
</body>
</html>