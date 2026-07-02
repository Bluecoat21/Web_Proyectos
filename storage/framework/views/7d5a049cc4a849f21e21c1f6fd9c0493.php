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

    <nav class="bg-gray-900 border-b border-gray-800 px-6 py-4 flex flex-col sm:flex-row justify-between items-center gap-4 shrink-0">
        <div class="flex items-center gap-2">
            <span class="text-orange-500 font-black italic tracking-wider text-xl">PROYECTO -X</span>
            <span class="bg-orange-500/10 text-orange-400 text-xs px-2.5 py-1 rounded-md font-bold uppercase tracking-widest border border-orange-500/20">Admin Engine</span>
        </div>

        <div class="flex items-center gap-2 bg-[#0f172a] p-1.5 rounded-xl border border-gray-800">
            <a href="<?php echo e(route('admin.analizador.index')); ?>" class="text-xs uppercase tracking-wider font-bold px-4 py-2 text-gray-400 hover:text-white rounded-lg transition-all">
                Analizador IA
            </a>
            <a href="<?php echo e(route('admin.subir')); ?>" class="text-xs uppercase tracking-wider font-bold px-4 py-2 bg-orange-500 text-white rounded-lg transition-all shadow-md shadow-orange-500/10">
                Gestión Portafolio
            </a>
        </div>

        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                <p class="text-xs font-bold text-white"><?php echo e(Auth::user()->name ?? 'Administrador'); ?></p>
                <p class="text-[10px] text-gray-500 font-mono">Nivel: Administrador</p>
            </div>
            
            <form action="<?php echo e(route('admin.logout')); ?>" method="POST" class="inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="bg-red-500/10 hover:bg-red-600 text-red-400 hover:text-white border border-red-500/20 text-xs font-bold px-4 py-2 rounded-xl transition-all">
                    Salir
                </button>
            </form>
        </div>
    </nav>

    <main class="flex-grow py-12 px-6 max-w-7xl mx-auto w-full space-y-8">
        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs font-bold p-4 rounded-xl flex items-center gap-2">
                <span>✔ <?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="bg-gray-900 p-8 rounded-3xl border border-gray-800">
                <h2 class="text-xl font-bold mb-6 text-orange-500 uppercase italic tracking-tight">Subir Nuevo Trabajo</h2>
                
                <form action="<?php echo e(route('portafolio.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Título del Proyecto</label>
                        <input type="text" name="titulo" class="w-full bg-black border border-gray-800 rounded-xl p-3 text-white focus:border-orange-500 outline-none text-sm" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Imagen de Carátula (JPG/PNG)</label>
                        <input type="file" name="caratula" accept="image/*" class="w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600" required>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-400 mb-2">Documento PDF</label>
                        <input type="file" name="pdf" accept="application/pdf" class="w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gray-700 file:text-white hover:file:bg-gray-600" required>
                    </div>

                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-black py-3.5 rounded-xl text-xs uppercase tracking-wider transition-all shadow-lg shadow-orange-500/10">
                        PUBLICAR EN PORTAFOLIO
                    </button>
                </form>
            </div>

            <div class="lg:col-span-2 bg-gray-900 p-8 rounded-3xl border border-gray-800">
                <h2 class="text-xl font-bold mb-6 text-white uppercase tracking-tight">Trabajos Publicados</h2>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm border-collapse">
                        <thead>
                            <tr class="border-b border-gray-800 text-gray-400 text-xs font-bold uppercase">
                                <th class="pb-3 w-16">Vista</th>
                                <th class="pb-3">Título</th>
                                <th class="pb-3 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800/50">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $trabajos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trabajo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <tr class="hover:bg-gray-800/20 transition-colors">
                                    <td class="py-4">
                                        <img src="<?php echo e(asset('storage/' . $trabajo->caratula)); ?>" class="w-12 h-12 object-cover rounded-lg border border-gray-800">
                                    </td>
                                    <td class="py-4 font-semibold text-gray-200">
                                        <?php echo e($trabajo->titulo); ?>

                                    </td>
                                    <td class="py-4 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="<?php echo e(route('portafolio.edit', $trabajo->id)); ?>" class="bg-gray-800 hover:bg-gray-700 text-gray-300 font-bold text-xs px-3 py-1.5 rounded-lg transition-colors">
                                                Editar
                                            </a>

                                            <form action="<?php echo e(route('portafolio.destroy', $trabajo->id)); ?>" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este proyecto de manera permanente?');" class="inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="bg-red-600/10 hover:bg-red-600 text-red-400 hover:text-white border border-red-500/20 text-xs font-bold px-3 py-1.5 rounded-lg transition-all">
                                                    Borrar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trabajos->isEmpty()): ?>
                                <tr>
                                    <td colspan="3" class="text-center py-8 text-gray-500 text-xs italic">No hay proyectos subidos actualmente.</td>
                                </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>
</html><?php /**PATH C:\Users\Diurno\Documents\Web_Proyectos\resources\views/admin/subir.blade.php ENDPATH**/ ?>