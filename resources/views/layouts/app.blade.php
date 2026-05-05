<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración | Proyecto -X</title>
    
    <!-- Tailwind via CDN (Sin Node.js) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    @livewireStyles
</head>
<body class="bg-[#0f172a] text-white">

    <div class="py-12">
        {{ $slot }}
    </div>

    @livewireScripts
</body>
</html>