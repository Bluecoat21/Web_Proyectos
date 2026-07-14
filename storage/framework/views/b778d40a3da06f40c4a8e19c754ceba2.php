<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto -X | Consultoría Académica y Auditoría</title>
    
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; scroll-behavior: smooth; }
        .brand-gradient { background: linear-gradient(135deg, #f97316 0%, #dc2626 100%); }
        .text-brand-gradient {
            background: linear-gradient(135deg, #f97316, #dc2626);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .btn-brand { 
            background-color: #f97316; 
            transition: all 0.3s ease; 
        }
        .btn-brand:hover { 
            background-color: #dc2626; 
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(220, 38, 38, 0.3);
        }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-900">

    <header class="brand-gradient text-white py-24 px-4 text-center shadow-2xl relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                <path fill="#FFFFFF" d="M44.7,-76.4C58.1,-69.2,69.2,-58.1,76.4,-44.7C83.7,-31.3,87.1,-15.7,85.1,-0.7C83.2,14.2,75.9,28.5,67.7,41.9C59.5,55.3,50.3,67.8,38.1,74.1C25.9,80.5,10.7,80.7,-4.1,87.8C-18.9,94.9,-33.2,108.9,-45.4,102.6C-57.6,96.2,-67.7,69.5,-74.6,56.1C-81.5,42.7,-85.2,22.6,-83.1,4.1C-81,-14.4,-73.1,-31.3,-61.8,-43.3C-50.5,-55.3,-35.8,-62.4,-22.4,-69.6C-9,-76.8,3.1,-84.1,44.7,-76.4Z" transform="translate(100 100)" />
            </svg>
        </div>
        
        <div class="relative z-10">
            <!-- Título reemplazado por imagen con enlace -->
            <div class="mb-6 flex justify-center">
                <a href="<?php echo e(Route::has('presentacion') ? route('presentacion') : '#'); ?>" class="inline-block transition-transform hover:scale-105">
                    <img src="<?php echo e(asset('images/assets/logo1.png')); ?>" 
                         alt="Proyecto -X" 
                         class="h-24 md:h-32 w-auto object-contain mix-blend-lighten">
                </a>
            </div>

            <p class="text-2xl font-bold mb-4">Consultoría Académica Integral</p>
            <p class="text-xl opacity-90 font-medium max-w-3xl mx-auto leading-relaxed">
                Auditoría especializada, asesoría de tesis y desarrollo de proyectos técnicos. 
                Convertimos la complejidad en resultados aprobados.
            </p>
            <div class="mt-10">
                <a href="#servicios" class="bg-white text-red-600 font-black px-10 py-4 rounded-full shadow-xl hover:bg-gray-100 transition-all uppercase tracking-widest text-sm">
                    Ver Servicios
                </a>
            </div>
        </div>
    </header>

    <main class="max-w-7xl mx-auto py-20 px-6">
        
        <section class="mb-32 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="bg-white p-10 rounded-3xl shadow-sm border-b-8 border-orange-500 card-hover transition-all duration-300 text-center">
                <div class="text-orange-500 mb-6 flex justify-center">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h4 class="font-bold text-xl mb-3 uppercase tracking-tight">Rigor Académico</h4>
                <p class="text-gray-500 text-sm">Auditorías minuciosas que garantizan el cumplimiento de normativas APA, Vancouver e IEEE.</p>
            </div>
            <div class="bg-white p-10 rounded-3xl shadow-sm border-b-8 border-red-600 card-hover transition-all duration-300 text-center">
                <div class="text-red-600 mb-6 flex justify-center">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h4 class="font-bold text-xl mb-3 uppercase tracking-tight">Entrega Express</h4>
                <p class="text-gray-500 text-sm">Gestión de tiempos optimizada para cumplir con tus plazos universitarios más exigentes.</p>
            </div>
            <div class="bg-white p-10 rounded-3xl shadow-sm border-b-8 border-orange-600 card-hover transition-all duration-300 text-center">
                <div class="text-orange-600 mb-6 flex justify-center">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                </div>
                <h4 class="font-bold text-xl mb-3 uppercase tracking-tight">Asesoría 1 a 1</h4>
                <p class="text-gray-500 text-sm">Canal directo vía WhatsApp para seguimiento en tiempo real de cada avance del proyecto.</p>
            </div>
        </section>

        <section id="servicios" class="mb-32">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black text-brand-gradient uppercase inline-block border-b-4 border-orange-500 pb-2 italic">
                    Nuestros Servicios
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $servicios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $servicio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 flex flex-col overflow-hidden card-hover transition-all">
                    <div class="p-8 flex-grow">
                        <h3 class="text-2xl font-extrabold text-gray-800 mb-4"><?php echo e($servicio->titulo); ?></h3>
                        <p class="text-gray-600 mb-8 text-sm leading-relaxed text-justify">
                            <?php echo e($servicio->descripcion); ?>

                        </p>
                        <div class="bg-orange-50 p-5 rounded-2xl mb-8 border-l-8 border-orange-500">
                            <span class="text-xs uppercase text-orange-600 font-bold tracking-widest">Inversión base</span>
                            <div class="text-3xl font-black text-red-600">$<?php echo e(number_format($servicio->precio_base, 2)); ?></div>
                        </div>

                        <form action="<?php echo e(route('consultas.store')); ?>" method="POST" class="space-y-4">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="servicio_id" value="<?php echo e($servicio->id); ?>">
                            <input type="text" name="nombre" placeholder="Nombre completo" required
                                class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 outline-none">
                            <input type="tel" name="telefono" placeholder="WhatsApp" required
                                class="w-full px-5 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-orange-500 outline-none">
                            <button type="submit" class="w-full btn-brand text-white font-black py-4 rounded-xl uppercase tracking-tighter shadow-lg">
                                Consultar por WhatsApp
                            </button>
                        </form>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </section>

<section class="mb-32">
    <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
        <div>
            <h2 class="text-4xl font-black text-gray-800 uppercase tracking-tighter">
                Nuestros Entregables
            </h2>
            <p class="text-gray-500 mt-2">
                Calidad profesional demostrada en cada documento y software.
            </p>
        </div>

        <a href="<?php echo e(Route::has('portafolio.index') ? route('portafolio.index') : '#'); ?>"
            class="px-8 py-3 border-2 border-orange-500 text-orange-600 font-bold rounded-xl hover:bg-orange-500 hover:text-white transition duration-300">
            Ver Portafolio Completo
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <!-- CARD 1 -->
        <div
            class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">

            <div class="relative h-72 overflow-hidden">

                <img
                    src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?auto=format&fit=crop&w=1200&q=80"
                    class="w-full h-full object-cover group-hover:scale-110 duration-700">

                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end p-6">

                    <div
                        class="w-12 h-12 rounded-full bg-orange-500 flex items-center justify-center mb-3">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 12h6M9 16h6M9 8h6M5 4h14v16H5z"/>

                        </svg>

                    </div>

                </div>

            </div>

            <div class="p-6">

                <h3 class="text-xl font-black text-gray-800 uppercase">
                    Auditoría Documental
                </h3>

                <p class="text-gray-500 mt-3 leading-relaxed">

                    Revisión profunda de estructura, citación,
                    normas APA, coherencia científica y formato
                    profesional.

                </p>

            </div>

        </div>

        <!-- CARD 2 -->

        <div
            class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">

            <div class="relative h-72 overflow-hidden">

                <img
                    src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80"
                    class="w-full h-full object-cover group-hover:scale-110 duration-700">

                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end p-6">

                    <div
                        class="w-12 h-12 rounded-full bg-orange-500 flex items-center justify-center mb-3">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 19V6m0 0L7 10m4-4l4 4"/>

                        </svg>

                    </div>

                </div>

            </div>

            <div class="p-6">

                <h3 class="text-xl font-black text-gray-800 uppercase">
                    Análisis y Modelado
                </h3>

                <p class="text-gray-500 mt-3 leading-relaxed">

                    Procesamiento de datos con MATLAB,
                    Python, SPSS, ArcGIS y modelos
                    estadísticos de investigación.

                </p>

            </div>

        </div>

        <!-- CARD 3 -->

        <div
            class="group bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500">

            <div class="relative h-72 overflow-hidden">

                <img
                    src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1200&q=80"
                    class="w-full h-full object-cover group-hover:scale-110 duration-700">

                <div
                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end p-6">

                    <div
                        class="w-12 h-12 rounded-full bg-orange-500 flex items-center justify-center mb-3">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-6 h-6 text-white"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M9.75 17L15 12l-5.25-5"/>

                        </svg>

                    </div>

                </div>

            </div>

            <div class="p-6">

                <h3 class="text-xl font-black text-gray-800 uppercase">
                    Software Especializado
                </h3>

                <p class="text-gray-500 mt-3 leading-relaxed">

                    Desarrollo de aplicaciones, simuladores,
                    dashboards y herramientas
                    personalizadas para proyectos.

                </p>

            </div>

        </div>

    </div>

</section>
    </main>

    <footer class="bg-gray-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12 border-b border-gray-800 pb-12">
            <div>
                <h3 class="text-3xl font-black mb-4 italic text-brand-gradient">Proyecto -X</h3>
                <p class="text-gray-400 leading-relaxed">
                    Elevando el estándar de la investigación académica y la consultoría técnica en todo el país.
                </p>
            </div>
            <div>
                <h4 class="font-bold mb-4 uppercase tracking-widest text-orange-500">Contacto</h4>
                <ul class="text-gray-400 space-y-2">
                    <li>Soporte: WhatsApp Directo</li>
                    <li>Horario: Lun - Vie / 9am - 7pm</li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4 uppercase tracking-widest text-orange-500">Legal</h4>
                <ul class="text-gray-400 space-y-2">
                    <li>Confidencialidad Garantizada</li>
                    <li>Términos de Servicio</li>
                </ul>
            </div>
        </div>
        
        <!-- SECCIÓN DE COPYRIGHT MODIFICADA: Enlace sutil para la administración -->
        <div class="max-w-7xl mx-auto px-6 mt-12 flex flex-col sm:flex-row justify-between items-center gap-4 text-gray-600 text-xs">
            <div>
                &copy; <?php echo e(date('Y')); ?> Proyecto -X. Todos los derechos reservados.
            </div>
            <div>
                <a href="<?php echo e(route('admin.login')); ?>" class="hover:text-orange-500 transition-colors duration-200 uppercase tracking-widest font-semibold flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Gestión Interna
                </a>
            </div>
        </div>
    </footer>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html><?php /**PATH C:\Users\Diurno\Documents\Web_Proyectos\resources\views/welcome.blade.php ENDPATH**/ ?>