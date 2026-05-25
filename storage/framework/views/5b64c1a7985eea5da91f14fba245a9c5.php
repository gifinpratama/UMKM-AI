<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'UMKM-AI - Sistem Analisis & Digitalisasi UMKM'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Platform analisis dan digitalisasi UMKM berbasis AI untuk membantu bisnis Anda tumbuh lebih cerdas.'); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700;800&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.2/lib/anime.min.js"></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="antialiased">

    
    <div id="beta-banner" style="background:#000;color:#fff;font-family:'Space Mono',monospace;font-size:12px;padding:8px 24px;display:flex;align-items:center;justify-content:space-between;gap:16px;border-bottom:3px solid #FAAE2B;position:fixed;top:0;left:0;right:0;z-index:200;">
        <div style="display:flex;align-items:center;gap:10px;">
            <span style="background:#FAAE2B;color:#000;font-family:'Space Grotesk',sans-serif;font-size:10px;font-weight:800;padding:2px 8px;border-radius:4px;letter-spacing:0.08em;">BETA</span>
            <span>Tahap Uji Coba Aplikasi — Fitur dapat berubah sewaktu-waktu.</span>
        </div>
        <button onclick="closeBetaBanner()" style="background:none;border:none;color:#fff;cursor:pointer;font-size:16px;line-height:1;padding:0 4px;opacity:0.7;" title="Tutup">&times;</button>
    </div>
    <script>
        function closeBetaBanner() {
            document.getElementById('beta-banner').style.display = 'none';
            const nav = document.querySelector('nav.fixed');
            if (nav) nav.style.top = '0';
        }
    </script>

    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH F:\laragon\www\project-ai\resources\views/layouts/landing.blade.php ENDPATH**/ ?>