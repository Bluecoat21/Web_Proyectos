<div class="bg-white border border-gray-200 rounded-3xl shadow-2xl overflow-hidden">
    <div class="bg-gray-900 p-4 text-white flex justify-between items-center">
        <span class="font-black italic text-orange-500">PROYECTO -X</span>
        <span class="text-[10px] uppercase font-bold tracking-widest opacity-60">Cotizador Express</span>
    </div>
    
    <div class="p-6">
        <div class="space-y-4 mb-6">
            <select wire:model.live="tipo_trabajo" class="w-full p-3 bg-gray-100 rounded-xl text-sm font-bold border-none">
                <option value="tesis">Tesis Académica</option>
                <option value="auditoria">Auditoría de Estilo</option>
                <option value="software">Software Técnico</option>
                <option value="analisis">Análisis de Datos</option>
            </select>

            <select wire:model.live="urgencia" class="w-full p-3 bg-gray-100 rounded-xl text-sm font-bold border-none">
                <option value="1">Entrega Estándar</option>
                <option value="1.5">Entrega Urgente</option>
                <option value="2">Entrega Inmediata</option>
            </select>

            <input type="text" wire:model.live="nombre" placeholder="Tu nombre..." 
                   class="w-full p-3 bg-gray-100 rounded-xl text-sm border-none">
        </div>

        <div class="bg-orange-50 p-4 rounded-2xl text-center border-2 border-orange-100">
            <div class="text-xs font-black text-orange-600 uppercase mb-1">Total Estimado</div>
            <div class="text-4xl font-black text-gray-900">$<?php echo e(number_format($this->total, 2)); ?></div>
        </div>

        <a href="<?php echo e($this->whatsappUrl); ?>" target="_blank" 
           class="mt-4 flex items-center justify-center w-full bg-green-500 text-white font-bold py-3 rounded-xl hover:bg-green-600 transition-all text-sm uppercase tracking-tighter shadow-lg">
           Enviar a WhatsApp
        </a>
    </div>
</div><?php /**PATH C:\Users\Diurno\Documents\Web_Proyectos\resources\views\livewire/calculador-presupuesto.blade.php ENDPATH**/ ?>