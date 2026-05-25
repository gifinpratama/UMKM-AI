
<aside id="sidebar" class="sidebar">
    
    <div class="sidebar-brand">
        <a href="<?php echo e(auth()->user()->isAdmin() ? route('admin.dashboard') : route('seller.dashboard')); ?>"
           style="display:flex;align-items:center;gap:10px;text-decoration:none;">
            <div style="width:40px;height:40px;border-radius:6px;background:var(--color-orange);border:3px solid #000;box-shadow:var(--nb-shadow-sm);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="20" height="20" fill="none" stroke="#000" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div>
                <span style="font-family:var(--font-display);font-size:22px;font-weight:800;color:#000;letter-spacing:-0.5px;">UMKM-AI</span>
                <p style="font-family:var(--font-body);font-size:10px;color:#555;margin:0;letter-spacing:0.05em;">Analisis Cerdas</p>
            </div>
        </a>
    </div>

    
    <nav style="flex:1;overflow-y:auto;padding:8px 0 80px;">
        <?php if(auth()->user()->isAdmin()): ?>
            <p class="sidebar-section-label">Menu Utama</p>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Dashboard
            </a>

            <p class="sidebar-section-label">Manajemen</p>
            <a href="<?php echo e(route('admin.sellers.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.sellers.index', 'admin.sellers.show') ? 'active' : ''); ?>">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Kelola Seller
            </a>
            <a href="<?php echo e(route('admin.sellers.create')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.sellers.create') ? 'active' : ''); ?>">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                Tambah Seller
            </a>

            <p class="sidebar-section-label">Analitik & Sistem</p>
            <a href="<?php echo e(route('admin.analytics')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.analytics') ? 'active' : ''); ?>">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Analytics Global
            </a>
            <a href="<?php echo e(route('admin.settings')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.settings*') ? 'active' : ''); ?>">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Pengaturan
            </a>

        <?php else: ?>
            <p class="sidebar-section-label">Menu Utama</p>
            <a href="<?php echo e(route('seller.dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('seller.dashboard') ? 'active' : ''); ?>">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Dashboard
            </a>

            <p class="sidebar-section-label">Bisnis</p>
            <a href="<?php echo e(route('seller.products.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('seller.products.*') ? 'active' : ''); ?>">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Produk
            </a>
            <a href="<?php echo e(route('seller.transactions.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('seller.transactions.*') ? 'active' : ''); ?>">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Transaksi
            </a>
            <a href="<?php echo e(route('seller.customers.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('seller.customers.*') ? 'active' : ''); ?>">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                Pelanggan
            </a>

            <p class="sidebar-section-label">AI & Analitik</p>
            <a href="<?php echo e(route('seller.analytics')); ?>" class="sidebar-link <?php echo e(request()->routeIs('seller.analytics*') ? 'active' : ''); ?>">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                Analisis AI
            </a>

            <p class="sidebar-section-label">Akun</p>
            <a href="<?php echo e(route('seller.profile')); ?>" class="sidebar-link <?php echo e(request()->routeIs('seller.profile*') ? 'active' : ''); ?>">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Profil Bisnis
            </a>
        <?php endif; ?>
    </nav>

    
    <div style="position:absolute;bottom:0;left:0;right:0;padding:14px 16px;border-top:3px solid #000;background:var(--color-golden-light);">
        <div style="display:flex;align-items:center;gap:10px;">
            <div style="width:36px;height:36px;border-radius:6px;background:var(--color-teal);border:3px solid #000;box-shadow:var(--nb-shadow-sm);display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-weight:800;color:#000;font-size:14px;flex-shrink:0;">
                <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

            </div>
            <div style="flex:1;min-width:0;">
                <p style="font-family:var(--font-display);font-size:13px;font-weight:700;color:#000;margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?php echo e(auth()->user()->name); ?></p>
                <p style="font-family:var(--font-body);font-size:10px;color:#555;margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?php echo e(auth()->user()->isAdmin() ? 'Administrator' : auth()->user()->business_name); ?></p>
            </div>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" title="Logout" class="btn-danger btn-sm" style="padding:6px 10px;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
        </div>
    </div>
</aside>
<?php /**PATH F:\laragon\www\project-ai\resources\views/components/sidebar.blade.php ENDPATH**/ ?>