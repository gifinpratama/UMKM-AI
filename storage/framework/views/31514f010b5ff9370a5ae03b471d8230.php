
<header class="navbar">
    
    <div style="display:flex;align-items:center;gap:16px;">
        <button onclick="toggleSidebar()" id="sidebar-toggle-btn"
            style="width:40px;height:40px;border-radius:6px;border:3px solid #000;background:var(--color-golden);box-shadow:var(--nb-shadow-sm);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.08s ease;"
            onmouseover="this.style.transform='translate(-2px,-2px)';this.style.boxShadow='var(--nb-shadow)'"
            onmouseout="this.style.transform='';this.style.boxShadow='var(--nb-shadow-sm)'">
            <svg width="18" height="18" fill="none" stroke="#000" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div>
            <h1
                style="font-family:var(--font-display);font-size:20px;font-weight:800;color:#000;margin:0;line-height:1.1;letter-spacing:-0.3px;">
                <?php echo $__env->yieldContent('page_title', 'Dashboard'); ?>
            </h1>
            <p style="font-family:var(--font-body);font-size:11px;color:#555;margin:0;">
                <?php echo $__env->yieldContent('page_subtitle', now()->format('l, d F Y')); ?>
            </p>
        </div>
    </div>

    
    <div style="display:flex;align-items:center;gap:10px;">
        
        <button
            style="position:relative;width:40px;height:40px;border-radius:6px;border:3px solid #000;background:#fff;box-shadow:var(--nb-shadow-sm);cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all 0.08s ease;"
            onmouseover="this.style.transform='translate(-2px,-2px)';this.style.boxShadow='var(--nb-shadow)'"
            onmouseout="this.style.transform='';this.style.boxShadow='var(--nb-shadow-sm)'">
            <svg width="18" height="18" fill="none" stroke="#000" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span
                style="position:absolute;top:6px;right:6px;width:9px;height:9px;background:var(--color-orange);border-radius:50%;border:2px solid #000;"></span>
        </button>

        
        <div
            style="display:flex;align-items:center;gap:8px;padding:6px 14px 6px 8px;border-radius:6px;border:3px solid #000;background:var(--color-teal);box-shadow:var(--nb-shadow-sm);">
            <div
                style="width:28px;height:28px;border-radius:4px;background:#000;display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-weight:800;color:var(--color-golden);font-size:13px;">
                <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

            </div>
            <span style="font-family:var(--font-display);font-size:13px;font-weight:700;color:#000;">
                <?php echo e(auth()->user()->name); ?>

            </span>
        </div>
    </div>
</header><?php /**PATH F:\laragon\www\project-ai\resources\views/components/navbar.blade.php ENDPATH**/ ?>