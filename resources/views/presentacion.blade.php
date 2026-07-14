<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a Proyecto -X</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        
        .bg-pattern {
            background-color: #0a0a0a;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .logo-glow {
            filter: drop-shadow(0 0 15px rgba(249, 115, 22, 0.4));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .btn-gradient {
            background: linear-gradient(135deg, #f97316 0%, #dc2626 100%);
        }
    </style>
</head>
<body class="bg-pattern text-white flex items-center justify-center min-h-screen overflow-hidden">
    
    <!-- Luces de fondo ambientales -->
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-orange-600 rounded-full blur-[150px] opacity-20"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-green-900 rounded-full blur-[150px] opacity-10"></div>

    <div class="text-center px-6 relative z-10">
        
        <!-- Contenedor del Logo -->
        <div class="mb-8 flex justify-center">
            <img src="{{ asset('images/assets/logo1.png') }}" 
                 alt="Proyecto -X Logo" 
                 class="h-28 md:h-40 w-auto logo-glow object-contain mix-blend-lighten">
        </div>

        <!-- Texto Descriptivo -->
        <p class="text-xl md:text-2xl text-gray-400 mb-12 font-light max-w-2xl mx-auto leading-relaxed">
            Consultoría Académica de <span class="text-white font-semibold">Alto Nivel</span>. <br>
            Donde la precisión técnica se encuentra con la excelencia universitaria.
        </p>

        <!-- Botones de Acción -->
        <div class="flex flex-col md:flex-row gap-6 justify-center items-center">
            <a href="{{ route('servicios.index') }}" 
               class="btn-gradient hover:opacity-90 text-white font-black py-5 px-12 rounded-xl text-lg transition-all transform hover:scale-105 shadow-[0_10px_20px_-10px_rgba(249,115,22,0.5)] uppercase tracking-wider">
                EXPLORAR SERVICIOS
            </a>
            
            <a href="https://wa.me/51913258623" 
               class="group border-2 border-gray-700 hover:border-green-600 py-5 px-12 rounded-xl font-bold transition-all text-lg flex items-center gap-3">
                <span class="group-hover:text-green-500 transition-colors uppercase tracking-wider">CONTACTO DIRECTO</span>
            </a>
        </div>

        <!-- Footer muy sutil -->
        <div class="mt-16 text-gray-600 text-xs uppercase tracking-[0.2em]">
            Expertos en Auditoría y Desarrollo de Proyectos Técnicos
        </div>
    </div>

</body>
</html>