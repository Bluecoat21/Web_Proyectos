<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración | Proyecto -X</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body class="bg-[#0f172a] text-white">

    <div class="py-12">
        <?php echo e($slot); ?>

    </div>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scriptConfig(); ?>

</body>
</html><?php /**PATH C:\Users\Diurno\Documents\Web_Proyectos\resources\views/layouts/app.blade.php ENDPATH**/ ?>