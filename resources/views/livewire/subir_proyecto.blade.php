<div class="max-w-2xl mx-auto bg-gray-900 p-8 rounded-3xl border border-gray-800">
    <form wire:submit.prevent="save">
        @csrf
        
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
@error('caratula') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
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
@error('pdf') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        <button type="submit" wire:loading.attr="disabled" class="w-full bg-orange-500 py-4 rounded-xl font-black text-white hover:bg-orange-600 disabled:opacity-50">
            <span wire:loading.remove>Subir y Publicar</span>
            <span wire:loading>Guardando en Base de Datos...</span>
        </button>
    </form>
</div>