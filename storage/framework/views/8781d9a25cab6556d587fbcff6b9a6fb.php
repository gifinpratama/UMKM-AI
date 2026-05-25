<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> - UMKM-AI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;600;700;800&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/animejs@3.2.2/lib/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="antialiased">

    
    <div id="beta-banner" style="background:#000;color:#fff;font-family:var(--font-body);font-size:12px;padding:8px 24px;display:flex;align-items:center;justify-content:space-between;gap:16px;border-bottom:3px solid var(--color-golden);position:relative;z-index:100;">
        <div style="display:flex;align-items:center;gap:10px;">
            <span style="background:var(--color-golden);color:#000;font-family:var(--font-display);font-size:10px;font-weight:800;padding:2px 8px;border-radius:4px;letter-spacing:0.08em;">BETA</span>
            <span>Tahap Uji Coba Aplikasi — Fitur dapat berubah sewaktu-waktu.</span>
        </div>
        <button onclick="document.getElementById('beta-banner').style.display='none'" style="background:none;border:none;color:#fff;cursor:pointer;font-size:16px;line-height:1;padding:0 4px;opacity:0.7;" title="Tutup">&times;</button>
    </div>

    <div class="flex min-h-screen">
        
        <?php echo $__env->make('components.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        
        <div class="main-content">
            
            <?php echo $__env->make('components.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            
            <main class="p-6">
                
                <?php if(session('success')): ?>
                <div id="flash-success" class="alert alert-success">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <?php echo e(session('success')); ?>

                </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                <div class="alert alert-error">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <?php echo e(session('error')); ?>

                </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>

    
    <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('hidden');
        }

        // Auto-hide flash messages
        setTimeout(() => {
            const flash = document.getElementById('flash-success');
            if (flash) {
                anime({
                    targets: flash,
                    opacity: [1, 0],
                    translateY: [0, -20],
                    duration: 500,
                    easing: 'easeInCubic',
                    complete: () => flash.remove()
                });
            }
        }, 4000);

        // Page entrance animation
        document.addEventListener('DOMContentLoaded', () => {
            anime({
                targets: 'main > *',
                opacity: [0, 1],
                translateY: [15, 0],
                duration: 600,
                delay: anime.stagger(80),
                easing: 'easeOutCubic'
            });
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH F:\laragon\www\project-ai\resources\views/layouts/app.blade.php ENDPATH**/ ?>