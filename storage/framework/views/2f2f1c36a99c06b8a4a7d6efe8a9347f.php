<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio | Proyecto -X</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
        
        .brand-gradient { background: linear-gradient(135deg, #f97316 0%, #dc2626 100%); }
        
        /* Efecto de brillo en las carátulas */
        .img-container::after {
            content: "";
            position: absolute;
            top: 0; left: -100%;
            width: 50%; height: 100%;
            background: linear-gradient(to right, transparent, rgba(255,255,255,0.1), transparent);
            transform: skewX(-25deg);
            transition: 0.5s;
        }
        .pdf-card:hover .img-container::after { left: 125%; }
        
        /* Animación para el overlay */
        .pdf-card:hover .overlay { opacity: 1; }
        
        .text-shadow-orange {
            text-shadow: 0 0 20px rgba(249, 115, 22, 0.4);
        }
    </style>
</head>
<body class="bg-[#0f172a] text-white min-h-screen">

    <nav class="border-b border-gray-800 bg-[#0f172a]/80 backdrop-blur-md sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">

            <img src="<?php echo e(asset('images/assets/logo1.png')); ?>" alt="Proyecto -X" class="h-12 w-auto"> 

            <a href="/" class="flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-orange-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver al Inicio
            </a>
        </div>
    </nav>

    <header class="py-20 px-6 relative overflow-hidden">
        <div class="max-w-7xl mx-auto text-center relative z-10">
            <h1 class="text-5xl md:text-7xl font-black uppercase italic tracking-tighter mb-6">
                Portafolio de <span class="text-orange-500 text-shadow-orange">Éxitos</span>
            </h1>
            <p class="text-gray-400 text-xl max-w-2xl mx-auto font-light leading-relaxed">
                Explora nuestra trayectoria en consultoría técnica y académica. 
                Documentación protegida y certificada por <span class="text-white font-bold">Proyecto -X</span>.
            </p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-6 pb-32">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $trabajos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trabajo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <div class="pdf-card group relative bg-gray-900/50 rounded-3xl overflow-hidden border border-gray-800 transition-all duration-300 hover:border-orange-500/50 hover:shadow-[0_20px_50px_rgba(249,115,22,0.1)]">
                
                <div class="img-container relative h-96 overflow-hidden bg-black">
                    <!-- CORRECCIÓN: Usamos la columna 'caratula' de tu BD -->
                    <img src="<?php echo e(asset('storage/' . $trabajo->caratula)); ?>" 
                         alt="<?php echo e($trabajo->titulo); ?>" 
                         class="w-full h-full object-cover opacity-70 group-hover:opacity-40 group-hover:scale-110 transition-all duration-700">
                    
                    <div class="overlay absolute inset-0 bg-orange-600/20 flex flex-col items-center justify-center opacity-0 transition-all duration-300 backdrop-blur-[2px]">
                        <!-- CORRECCIÓN: Usamos la columna 'pdf' de tu BD -->
                        <a href="<?php echo e(asset('storage/' . $trabajo->pdf)); ?>" 
                           target="_blank"
                           class="bg-white text-orange-600 font-black py-4 px-8 rounded-2xl flex items-center gap-3 transform translate-y-8 group-hover:translate-y-0 transition-all duration-500 hover:bg-orange-500 hover:text-white shadow-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            VER PROYECTO
                        </a>
                        <p class="text-[10px] text-white/70 uppercase tracking-[0.2em] font-bold mt-4 transform translate-y-8 group-hover:translate-y-0 transition-all duration-700">Documentación Oficial</p>
                    </div>
                </div>

                <div class="p-8">
                    <div class="flex justify-between items-center mb-4">
                        <span class="text-[10px] font-black uppercase tracking-widest text-orange-500 bg-orange-500/10 px-3 py-1 rounded-full border border-orange-500/20">
                            <?php echo e($trabajo->categoria ?? 'Certificado'); ?>

                        </span>
                    </div>
                    <h3 class="text-xl font-extrabold leading-tight text-white group-hover:text-orange-400 transition-colors uppercase italic tracking-tighter">
                        <?php echo e($trabajo->titulo); ?>

                    </h3>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <div class="col-span-full py-20 text-center border-2 border-dashed border-gray-800 rounded-3xl">
                <h3 class="text-xl font-bold text-gray-500 uppercase italic">Aún no hay proyectos cargados</h3>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>
    </main>

    <footer class="py-12 border-t border-gray-800 text-center">
        <p class="text-gray-600 text-xs tracking-widest uppercase font-bold">
            &copy; <?php echo e(date('Y')); ?> PROYECTO -X | Propiedad Intelectual Protegida
        </p>
    </footer>

</body>
</html><?php /**PATH C:\Users\Diurno\Documents\Web_Proyectos\resources\views/portafolio.blade.php ENDPATH**/ ?>