<div class="max-w-2xl mx-auto bg-gray-900 p-8 rounded-3xl border border-gray-800">
    <form wire:submit.prevent="save">
        <?php echo csrf_field(); ?>
        
        <div class="mb-4">
            <label class="text-orange-500 font-bold text-xs uppercase">Título del Proyecto</label>
            <input type="text" wire:model="titulo" class="w-full bg-black text-white p-3 rounded-xl border border-gray-700 outline-none focus:border-orange-500">
        </div>

        <!-- Barra de carga para la Carátula -->
        <div class="mb-4" x-data="{ uploading: false, progress: 0 }" 
             x-on:livewire-upload-start="uploading = true" 
             x-on:livewire-upload-finish="uploading = false" 
             x-on:livewire-upload-progress="progress = $event.detail.progress">
            
            <label class="text-orange-500 font-bold text-xs uppercase">Carátula (Imagen)</label>
            <input type="file" wire:model="caratula" class="block w-full text-sm text-gray-400 mt-2">

            <div x-show="uploading" class="w-full bg-gray-700 h-1 mt-2 rounded-full overflow-hidden">
                <div class="bg-orange-500 h-full transition-all" :style="`width: ${progress}%` text-align: center"></div>
            </div>
        </div>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['caratula'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <!-- Barra de carga para el PDF -->
        <div class="mb-6" x-data="{ uploading: false, progress: 0 }" 
             x-on:livewire-upload-start="uploading = true" 
             x-on:livewire-upload-finish="uploading = false" 
             x-on:livewire-upload-progress="progress = $event.detail.progress">
            
            <label class="text-orange-500 font-bold text-xs uppercase">Archivo PDF</label>
            <input type="file" wire:model="pdf" class="block w-full text-sm text-gray-400 mt-2">

            <div x-show="uploading" class="w-full bg-gray-800 h-4 mt-2 rounded-lg flex items-center">
                <div class="bg-blue-600 h-full text-[10px] text-white flex items-center justify-center transition-all" :style="`width: ${progress}%` text-align: center">
                    <span x-text="progress + '%'"></span>
                </div>
            </div>
        </div>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['pdf'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <button type="submit" wire:loading.attr="disabled" class="w-full bg-orange-500 py-4 rounded-xl font-black text-white hover:bg-orange-600 disabled:opacity-50">
            <span wire:loading.remove>Subir y Publicar</span>
            <span wire:loading>Guardando en Base de Datos...</span>
        </button>
    </form>
</div><?php /**PATH C:\Users\Diurno\Documents\Web_Proyectos\resources\views/livewire/subir_proyecto.blade.php ENDPATH**/ ?>