<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Trabajo - Admin Engine</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-[#0f172a] text-white flex flex-col min-h-screen">

    <nav class="bg-gray-900 border-b border-gray-800 px-6 py-4 flex justify-between items-center shrink-0">
        <div class="flex items-center gap-2">
            <span class="text-orange-500 font-black italic tracking-wider text-xl">PROYECTO -X</span>
            <span class="bg-orange-500/10 text-orange-400 text-xs px-2.5 py-1 rounded-md font-bold uppercase tracking-widest border border-orange-500/20">Admin Engine</span>
        </div>
        <a href="<?php echo e(route('admin.subir')); ?>" class="text-xs text-gray-400 hover:text-white uppercase tracking-wider font-bold transition-colors">
            ← Volver al Listado
        </a>
    </nav>

    <main class="flex-grow flex items-center justify-center py-12 px-6">
        <div class="max-w-2xl w-full bg-gray-900 p-8 rounded-3xl border border-gray-800 space-y-6">
            <h2 class="text-xl font-bold text-orange-500 uppercase italic">Modificar Proyecto</h2>
            
            <form action="<?php echo e(route('portafolio.update', $trabajo->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                
                <div>
                    <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Título del Proyecto</label>
                    <input type="text" name="titulo" value="<?php echo e(old('titulo', $trabajo->titulo)); ?>" class="w-full bg-black border border-gray-800 rounded-xl p-3 text-white focus:border-orange-500 outline-none text-sm" required>
                </div>

                <div class="p-4 bg-black/40 border border-gray-800/60 rounded-2xl grid grid-cols-1 sm:grid-cols-4 gap-4 items-center">
                    <div class="sm:col-span-1">
                        <p class="text-[10px] uppercase font-bold text-gray-500 mb-1">Carátula actual</p>
                        <img src="<?php echo e(asset('storage/' . $trabajo->caratula)); ?>" class="w-16 h-16 object-cover rounded-xl border border-gray-800">
                    </div>
                    <div class="sm:col-span-3">
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Reemplazar Carátula (Opcional)</label>
                        <input type="file" name="caratula" accept="image/*" class="w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600">
                    </div>
                </div>

                <div class="p-4 bg-black/40 border border-gray-800/60 rounded-2xl">
                    <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Reemplazar Documento PDF (Opcional)</label>
                    <input type="file" name="pdf" accept="application/pdf" class="w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gray-700 file:text-white hover:file:bg-gray-600">
                    <p class="text-[10px] text-gray-500 mt-2 font-mono truncate">Archivo original guardado de forma segura en el almacenamiento.</p>
                </div>

                <div class="flex gap-4 pt-2">
                    <a href="<?php echo e(route('admin.subir')); ?>" class="w-1/3 bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold text-xs py-4 rounded-xl uppercase tracking-wider text-center transition-colors">
                        Cancelar
                    </a>
                    <button type="submit" class="w-2/3 bg-orange-500 hover:bg-orange-600 text-white font-black py-4 rounded-xl text-xs uppercase tracking-wider transition-all shadow-md shadow-orange-500/10">
                        GUARDAR CAMBIOS
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>
</html><?php /**PATH C:\Users\Diurno\Documents\Web_Proyectos\resources\views/admin/editar_portafolio.blade.php ENDPATH**/ ?>