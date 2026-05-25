<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('page_title', 'Dashboard ' . auth()->user()->business_name); ?>
<?php $__env->startSection('page_subtitle', 'Overview bisnis kamu hari ini 📊'); ?>

<?php $__env->startSection('content'); ?>


<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;" class="stats-grid">

    
    <div class="stat-card" style="border-top:6px solid var(--color-orange);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
            <div style="width:40px;height:40px;border-radius:6px;background:var(--color-orange);border:3px solid #000;display:flex;align-items:center;justify-content:center;box-shadow:var(--nb-shadow-sm);">
                <svg width="20" height="20" fill="none" stroke="#000" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <?php if($stats['revenue_growth_percent'] != 0): ?>
            <span class="badge <?php echo e($stats['revenue_growth_percent'] > 0 ? 'badge-success' : 'badge-danger'); ?>">
                <?php echo e($stats['revenue_growth_percent'] > 0 ? '↑' : '↓'); ?> <?php echo e(abs($stats['revenue_growth_percent'])); ?>%
            </span>
            <?php endif; ?>
        </div>
        <p style="font-family:var(--font-display);font-size:20px;font-weight:800;color:#000;margin:0;letter-spacing:-0.5px;">Rp <?php echo e(number_format($stats['revenue_this_month'], 0, ',', '.')); ?></p>
        <p style="font-family:var(--font-body);font-size:11px;color:#555;margin:4px 0 0;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">Pendapatan Bulan Ini</p>
    </div>

    
    <div class="stat-card" style="border-top:6px solid var(--color-teal);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
            <div style="width:40px;height:40px;border-radius:6px;background:var(--color-teal);border:3px solid #000;display:flex;align-items:center;justify-content:center;box-shadow:var(--nb-shadow-sm);">
                <svg width="20" height="20" fill="none" stroke="#000" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
        </div>
        <p style="font-family:var(--font-display);font-size:28px;font-weight:800;color:#000;margin:0;letter-spacing:-0.5px;"><?php echo e($stats['transactions_this_month']); ?></p>
        <p style="font-family:var(--font-body);font-size:11px;color:#555;margin:4px 0 0;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">Transaksi Bulan Ini</p>
    </div>

    
    <div class="stat-card" style="border-top:6px solid var(--color-golden);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
            <div style="width:40px;height:40px;border-radius:6px;background:var(--color-golden);border:3px solid #000;display:flex;align-items:center;justify-content:center;box-shadow:var(--nb-shadow-sm);">
                <svg width="20" height="20" fill="none" stroke="#000" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <?php if($stats['low_stock_products'] > 0): ?>
            <span class="badge badge-warning"><?php echo e($stats['low_stock_products']); ?> rendah</span>
            <?php endif; ?>
        </div>
        <p style="font-family:var(--font-display);font-size:28px;font-weight:800;color:#000;margin:0;letter-spacing:-0.5px;"><?php echo e($stats['active_products']); ?></p>
        <p style="font-family:var(--font-body);font-size:11px;color:#555;margin:4px 0 0;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">Produk Aktif</p>
    </div>

    
    <div class="stat-card" style="border-top:6px solid var(--color-pink);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
            <div style="width:40px;height:40px;border-radius:6px;background:var(--color-pink);border:3px solid #000;display:flex;align-items:center;justify-content:center;box-shadow:var(--nb-shadow-sm);">
                <svg width="20" height="20" fill="none" stroke="#000" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </div>
        </div>
        <p style="font-family:var(--font-display);font-size:28px;font-weight:800;color:#000;margin:0;letter-spacing:-0.5px;"><?php echo e($stats['total_customers']); ?></p>
        <p style="font-family:var(--font-body);font-size:11px;color:#555;margin:4px 0 0;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">Total Pelanggan</p>
    </div>
</div>


<div style="display:grid;grid-template-columns:2fr 1fr;gap:16px;margin-bottom:24px;" class="charts-grid">

    
    <div class="card-elevated">
        <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:#000;margin:0 0 16px;display:flex;align-items:center;gap:8px;">
            <span style="display:inline-block;width:12px;height:12px;background:var(--color-orange);border:2px solid #000;"></span>
            Pendapatan 14 Hari Terakhir
        </h3>
        <canvas id="revenueChart" height="180"></canvas>
    </div>

    
    <div class="card-elevated">
        <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:#000;margin:0 0 16px;display:flex;align-items:center;gap:8px;">
            <span style="display:inline-block;width:12px;height:12px;background:var(--color-teal);border:2px solid #000;"></span>
            Metode Pembayaran
        </h3>
        <canvas id="paymentChart" height="160"></canvas>
        <div style="margin-top:12px;display:flex;flex-direction:column;gap:6px;">
            <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:6px 8px;border:2px solid #000;border-radius:4px;background:var(--color-surface-soft);">
                <span style="font-family:var(--font-body);font-size:12px;color:#000;font-weight:700;text-transform:capitalize;"><?php echo e($pm->payment_method); ?></span>
                <span style="font-family:var(--font-display);font-size:13px;font-weight:800;color:#000;"><?php echo e($pm->count); ?>x</span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>


<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px;" class="bottom-grid">

    
    <div class="card-elevated">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
            <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:#000;margin:0;">Transaksi Terbaru</h3>
            <a href="<?php echo e(route('seller.transactions.create')); ?>" class="btn-primary btn-sm">+ Baru</a>
        </div>
        <div style="display:flex;flex-direction:column;gap:8px;">
            <?php $__empty_1 = true; $__currentLoopData = $recentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trx): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;border:2px solid #000;border-radius:4px;background:var(--color-surface-soft);">
                <div>
                    <p style="font-family:var(--font-display);font-size:13px;font-weight:700;color:#000;margin:0;"><?php echo e($trx->customer_name); ?></p>
                    <p style="font-family:var(--font-body);font-size:10px;color:#777;margin:0;"><?php echo e($trx->transaction_code); ?></p>
                </div>
                <div style="text-align:right;">
                    <p style="font-family:var(--font-display);font-size:14px;font-weight:800;color:#000;margin:0;background:var(--color-orange);padding:3px 8px;border:2px solid #000;border-radius:4px;box-shadow:var(--nb-shadow-sm);">Rp <?php echo e(number_format($trx->total, 0, ',', '.')); ?></p>
                    <p style="font-family:var(--font-body);font-size:10px;color:#777;margin:2px 0 0;"><?php echo e($trx->created_at->diffForHumans()); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="font-family:var(--font-body);font-size:13px;color:#777;text-align:center;padding:20px;border:2px dashed #000;border-radius:4px;font-weight:700;">Belum ada transaksi</p>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="card-elevated" style="border-top:6px solid var(--color-golden);">
        <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:#000;margin:0 0 16px;display:flex;align-items:center;gap:8px;">
            ⚠️ Stok Rendah
        </h3>
        <div style="display:flex;flex-direction:column;gap:8px;">
            <?php $__empty_1 = true; $__currentLoopData = $lowStockProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;border:2px solid #000;border-radius:4px;background:var(--color-golden-light);">
                <div>
                    <p style="font-family:var(--font-display);font-size:13px;font-weight:700;color:#000;margin:0;"><?php echo e($product->name); ?></p>
                    <p style="font-family:var(--font-body);font-size:10px;color:#777;margin:0;"><?php echo e($product->sku ?? 'No SKU'); ?></p>
                </div>
                <span class="badge badge-warning">Stok: <?php echo e($product->stock); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="font-family:var(--font-body);font-size:13px;color:#333;text-align:center;padding:20px;border:2px dashed #000;border-radius:4px;font-weight:700;">✅ Semua stok aman!</p>
            <?php endif; ?>
        </div>
    </div>
</div>


<div style="background:#000;border:4px solid #000;border-radius:6px;box-shadow:var(--nb-shadow-lg);padding:24px;">
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
        <div style="width:44px;height:44px;border-radius:6px;background:var(--color-orange);border:3px solid var(--color-golden);display:flex;align-items:center;justify-content:center;box-shadow:var(--nb-shadow-sm);">
            <svg width="22" height="22" fill="none" stroke="#000" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
        </div>
        <div style="flex:1;">
            <h3 style="font-family:var(--font-display);font-size:18px;font-weight:800;color:var(--color-golden);margin:0;letter-spacing:-0.3px;">UMKM-AI Quick Insight</h3>
            <p style="font-family:var(--font-body);font-size:11px;color:#aaa;margin:0;font-weight:700;">Ringkasan performa bisnis kamu</p>
        </div>
        <a href="<?php echo e(route('seller.analytics')); ?>" class="btn-accent btn-sm">Analisis Lengkap →</a>
    </div>
    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;">
        <div style="background:var(--color-surface-white);border:3px solid var(--color-golden);border-radius:6px;padding:14px;text-align:center;box-shadow:var(--nb-shadow-sm);">
            <p style="font-family:var(--font-body);font-size:11px;color:#555;margin:0 0 4px;font-weight:700;text-transform:uppercase;">Rata-rata Transaksi</p>
            <p style="font-family:var(--font-display);font-size:18px;font-weight:800;color:#000;margin:0;letter-spacing:-0.3px;">Rp <?php echo e(number_format($stats['avg_transaction_value'], 0, ',', '.')); ?></p>
        </div>
        <div style="background:var(--color-surface-white);border:3px solid var(--color-golden);border-radius:6px;padding:14px;text-align:center;box-shadow:var(--nb-shadow-sm);">
            <p style="font-family:var(--font-body);font-size:11px;color:#555;margin:0 0 4px;font-weight:700;text-transform:uppercase;">vs Bulan Lalu</p>
            <p style="font-family:var(--font-display);font-size:18px;font-weight:800;color:<?php echo e($stats['revenue_growth_percent'] >= 0 ? 'var(--color-success)' : 'var(--color-danger)'); ?>;margin:0;letter-spacing:-0.3px;">
                <?php echo e($stats['revenue_growth_percent'] >= 0 ? '+' : ''); ?><?php echo e($stats['revenue_growth_percent']); ?>%
            </p>
        </div>
        <div style="background:var(--color-surface-white);border:3px solid var(--color-golden);border-radius:6px;padding:14px;text-align:center;box-shadow:var(--nb-shadow-sm);">
            <p style="font-family:var(--font-body);font-size:11px;color:#555;margin:0 0 4px;font-weight:700;text-transform:uppercase;">Stok Rendah</p>
            <p style="font-family:var(--font-display);font-size:18px;font-weight:800;color:<?php echo e($stats['low_stock_products'] > 0 ? 'var(--color-warning)' : 'var(--color-success)'); ?>;margin:0;letter-spacing:-0.3px;"><?php echo e($stats['low_stock_products']); ?></p>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Revenue chart
    const dailyData = <?php echo json_encode($dailyRevenue, 15, 512) ?>;
    const ctx1 = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: dailyData.map(d => d.date),
            datasets: [{
                label: 'Pendapatan',
                data: dailyData.map(d => d.revenue),
                borderColor: '#000000',
                backgroundColor: 'rgba(221,107,32,0.15)',
                fill: true,
                tension: 0.3,
                pointRadius: 4,
                pointBackgroundColor: '#DD6B20',
                pointBorderColor: '#000000',
                pointBorderWidth: 2,
                borderWidth: 3,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#000000',
                    titleColor: '#FAAE2B',
                    bodyColor: '#FFFFFF',
                    borderColor: '#FAAE2B',
                    borderWidth: 2,
                    cornerRadius: 4,
                    callbacks: { label: ctx => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID') }
                }
            },
            scales: {
                x: { grid: { color: '#EEEEEE' }, ticks: { color: '#333', font: { size: 10, family: 'Space Mono', weight: '700' }, maxRotation: 45 } },
                y: { grid: { color: '#EEEEEE' }, ticks: { color: '#333', font: { size: 10, family: 'Space Mono', weight: '700' }, callback: v => 'Rp ' + (v/1000).toFixed(0) + 'k' } }
            }
        }
    });

    // Payment doughnut
    const pmData = <?php echo json_encode($paymentMethods, 15, 512) ?>;
    const colors = ['#DD6B20','#8BD3DD','#FAAE2B','#FE98A3','#000000'];
    new Chart(document.getElementById('paymentChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: pmData.map(d => d.payment_method),
            datasets: [{ data: pmData.map(d => d.total), backgroundColor: colors.slice(0, pmData.length), borderWidth: 3, borderColor: '#000000' }]
        },
        options: { responsive: true, plugins: { legend: { display: false } }, cutout: '65%' }
    });

    anime({ targets: '.stat-card', opacity: [0,1], translateY: [20,0], delay: anime.stagger(80), duration: 450, easing: 'easeOutCubic' });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\laragon\www\project-ai\resources\views/seller/dashboard.blade.php ENDPATH**/ ?>