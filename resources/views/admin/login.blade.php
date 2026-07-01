<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROYECTO -X | Acceso Administrativo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-[#0f172a] text-gray-100 min-h-screen flex flex-col justify-center items-center px-4">

    <div class="max-w-md w-full bg-[#1e293b] p-8 rounded-3xl shadow-2xl border border-gray-800 space-y-6">
        
        <div class="text-center space-y-2">
            <span class="text-orange-500 font-black italic tracking-wider text-2xl">PROYECTO -X</span>
            <h2 class="text-xl font-bold uppercase tracking-tight text-white">Panel de Control</h2>
            <p class="text-gray-400 text-xs">Introduce tus credenciales para acceder a las herramientas protegidas.</p>
        </div>

        @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-bold p-4 rounded-xl">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-[11px] font-bold uppercase text-gray-400 mb-2 tracking-wide">Correo Electrónico</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full bg-[#0f172a] border border-gray-800 rounded-xl p-3.5 text-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all text-sm">
            </div>

            <div>
                <label class="block text-[11px] font-bold uppercase text-gray-400 mb-2 tracking-wide">Contraseña</label>
                <input type="password" name="password" required
                    class="w-full bg-[#0f172a] border border-gray-800 rounded-xl p-3.5 text-white focus:border-orange-500 focus:ring-1 focus:ring-orange-500 outline-none transition-all text-sm">
            </div>

            <div class="flex items-center justify-between pt-2">
                <label class="flex items-center gap-2 cursor-pointer select-none">
                    <input type="checkbox" name="remember" class="rounded bg-[#0f172a] border-gray-800 text-orange-500 focus:ring-0 focus:ring-offset-0">
                    <span class="text-xs text-gray-400">Recordar sesión</span>
                </label>
            </div>

            <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-black py-4 rounded-xl uppercase tracking-widest text-xs shadow-lg shadow-orange-500/10 transition-all active:scale-[0.98] mt-4">
                Ingresar al Sistema
            </button>
        </form>
    </div>

    <a href="/" class="mt-6 text-xs text-gray-500 hover:text-orange-400 transition-colors uppercase tracking-widest font-semibold">
        ← Volver al inicio público
    </a>

</body>
</html>