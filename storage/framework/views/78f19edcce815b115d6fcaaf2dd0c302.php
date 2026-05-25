<?php $__env->startSection('title', 'Analytics Global'); ?>
<?php $__env->startSection('page_title', 'Analytics Global'); ?>
<?php $__env->startSection('page_subtitle', 'Statistik dan performa seluruh UMKM'); ?>

<?php $__env->startSection('content'); ?>

<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">
    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
            <div style="width:40px;height:40px;border-radius:10px;background:rgba(34,164,71,0.12);display:flex;align-items:center;justify-content:center;">
                <svg width="20" height="20" fill="none" stroke="var(--color-success)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <?php if($growthPercent != 0): ?>
            <span class="badge <?php echo e($growthPercent > 0 ? 'badge-success' : 'badge-danger'); ?>"><?php echo e($growthPercent > 0 ? '↑' : '↓'); ?> <?php echo e(abs($growthPercent)); ?>%</span>
            <?php endif; ?>
        </div>
        <p style="font-family:var(--font-display);font-size:20px;font-weight:800;color:var(--color-text-primary);margin:0;">Rp <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></p>
        <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">Total Pendapatan Global</p>
    </div>
    <div class="stat-card">
        <div style="width:40px;height:40px;border-radius:10px;background:rgba(139,211,221,0.15);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
            <svg width="20" height="20" fill="none" stroke="var(--color-teal)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
        </div>
        <p style="font-family:var(--font-display);font-size:20px;font-weight:800;color:var(--color-text-primary);margin:0;"><?php echo e(number_format($totalTransactions)); ?></p>
        <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">Total Transaksi</p>
    </div>
    <div class="stat-card">
        <div style="width:40px;height:40px;border-radius:10px;background:rgba(221,107,32,0.12);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
            <svg width="20" height="20" fill="none" stroke="var(--color-orange)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
        </div>
        <p style="font-family:var(--font-display);font-size:20px;font-weight:800;color:var(--color-text-primary);margin:0;"><?php echo e(number_format($totalProducts)); ?></p>
        <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">Total Produk</p>
    </div>
    <div class="stat-card">
        <div style="width:40px;height:40px;border-radius:10px;background:rgba(250,174,43,0.12);display:flex;align-items:center;justify-content:center;margin-bottom:12px;">
            <svg width="20" height="20" fill="none" stroke="var(--color-golden)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
        </div>
        <p style="font-family:var(--font-display);font-size:20px;font-weight:800;color:var(--color-text-primary);margin:0;"><?php echo e(number_format($totalCustomers)); ?></p>
        <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">Total Pelanggan</p>
    </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:16px;margin-bottom:24px;">
    <div class="card-elevated">
        <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0 0 16px;">Tren Pendapatan Bulanan</h3>
        <canvas id="monthlyRevenueChart" height="200"></canvas>
    </div>
    <div class="card-elevated">
        <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0 0 16px;">Metode Pembayaran (Bulan Ini)</h3>
        <canvas id="paymentChart" height="200"></canvas>
        <div style="margin-top:12px;display:flex;flex-direction:column;gap:6px;">
            <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <span style="font-family:var(--font-body);font-size:13px;color:var(--color-text-secondary);text-transform:capitalize;"><?php echo e($pm->payment_method); ?></span>
                <span style="font-family:var(--font-body);font-size:13px;font-weight:600;color:var(--color-text-primary);"><?php echo e($pm->count); ?>x — Rp <?php echo e(number_format($pm->total, 0, ',', '.')); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px;">
    <div class="card-elevated">
        <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0 0 16px;">Transaksi Harian (Bulan Ini)</h3>
        <canvas id="dailyChart" height="200"></canvas>
    </div>
    <div class="card-elevated">
        <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0 0 16px;">Distribusi Jenis Bisnis</h3>
        <canvas id="businessTypeChart" height="200"></canvas>
    </div>
</div>

<div class="card-elevated" style="margin-bottom:24px;">
    <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0 0 16px;">Peringkat Seller Berdasarkan Pendapatan</h3>
    <div style="overflow-x:auto;">
        <table class="data-table">
            <thead><tr><th>#</th><th>Nama Bisnis</th><th style="text-align:right;">Transaksi</th><th style="text-align:right;">Pendapatan</th><th>Kontribusi</th></tr></thead>
            <tbody>
                <?php $__currentLoopData = $sellerRevenue; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <span style="width:24px;height:24px;border-radius:50%;background:<?php echo e($idx < 3 ? 'var(--color-orange)' : 'var(--color-surface-soft)'); ?>;display:inline-flex;align-items:center;justify-content:center;color:<?php echo e($idx < 3 ? '#fff' : 'var(--color-text-secondary)'); ?>;font-family:var(--font-body);font-size:12px;font-weight:700;border:2px solid #000;"><?php echo e($idx + 1); ?></span>
                    </td>
                    <td style="font-weight:600;"><?php echo e($seller['name']); ?></td>
                    <td style="text-align:right;"><?php echo e(number_format($seller['transactions'])); ?></td>
                    <td style="text-align:right;font-weight:700;color:var(--color-orange);">Rp <?php echo e(number_format($seller['revenue'], 0, ',', '.')); ?></td>
                    <td>
                        <?php $pct = $totalRevenue > 0 ? round(($seller['revenue'] / $totalRevenue) * 100, 1) : 0; ?>
                        <div style="display:flex;align-items:center;gap:8px;">
                            <div style="flex:1;height:6px;border-radius:3px;background:#e2e8f0;overflow:hidden;">
                                <div style="height:100%;border-radius:3px;background:var(--color-orange);width:<?php echo e($pct); ?>;"></div>
                            </div>
                            <span style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);width:40px;text-align:right;"><?php echo e($pct); ?>%</span>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
    <div class="card-elevated" style="border-left:4px solid var(--color-success);">
        <h3 style="font-family:var(--font-display);font-size:14px;font-weight:800;color:var(--color-text-primary);margin:0 0 8px;">Bulan Ini</h3>
        <p style="font-family:var(--font-display);font-size:28px;font-weight:800;color:var(--color-success);margin:0;">Rp <?php echo e(number_format($revenueThisMonth, 0, ',', '.')); ?></p>
        <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">Pendapatan bulan berjalan</p>
    </div>
    <div class="card-elevated" style="border-left:4px solid #000;">
        <h3 style="font-family:var(--font-display);font-size:14px;font-weight:800;color:var(--color-text-primary);margin:0 0 8px;">Bulan Lalu</h3>
        <p style="font-family:var(--font-display);font-size:28px;font-weight:800;color:var(--color-text-secondary);margin:0;">Rp <?php echo e(number_format($revenueLastMonth, 0, ',', '.')); ?></p>
        <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">Pendapatan bulan sebelumnya</p>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const chartDefaults = {
        responsive: true,
        plugins: { legend: { display: false }, tooltip: { backgroundColor: '#1A202C', borderColor: 'rgba(221,107,32,0.3)', borderWidth: 1, cornerRadius: 8, callbacks: { label: ctx => 'Rp ' + (ctx.parsed.y?.toLocaleString('id-ID') || ctx.parsed.toLocaleString('id-ID')) } } },
    };
    const gridStyle = { color: '#E2E8F0' };
    const tickStyle = { color: '#718096', font: { size: 10, family: 'IBM Plex Mono' } };

    const monthlyData = <?php echo json_encode($monthlyRevenue, 15, 512) ?>;
    const ctx1 = document.getElementById('monthlyRevenueChart').getContext('2d');
    const grad1 = ctx1.createLinearGradient(0, 0, 0, 200);
    grad1.addColorStop(0, 'rgba(221,107,32,0.25)');
    grad1.addColorStop(1, 'rgba(221,107,32,0.02)');
    new Chart(ctx1, {
        type: 'bar', data: {
            labels: monthlyData.map(d => d.month),
            datasets: [{ label: 'Pendapatan', data: monthlyData.map(d => d.revenue), backgroundColor: '#DD6B20', borderRadius: 6, borderSkipped: false }]
        }, options: { ...chartDefaults, scales: { x: { grid: gridStyle, ticks: tickStyle }, y: { grid: gridStyle, ticks: { ...tickStyle, callback: v => 'Rp ' + (v/1000000).toFixed(1) + 'M' } } } }
    });

    const pmData = <?php echo json_encode($paymentMethods, 15, 512) ?>;
    const pmColors = ['#DD6B20','#8BD3DD','#FAAE2B','#22A447','#FE98A3'];
    new Chart(document.getElementById('paymentChart').getContext('2d'), {
        type: 'doughnut', data: { labels: pmData.map(d => d.payment_method), datasets: [{ data: pmData.map(d => d.total), backgroundColor: pmColors, borderWidth: 2, borderColor: '#FFFFFF' }] },
        options: { responsive: true, plugins: { legend: { display: false } }, cutout: '70%' }
    });

    const dailyData = <?php echo json_encode($dailyTransactions, 15, 512) ?>;
    const ctx3 = document.getElementById('dailyChart').getContext('2d');
    const grad3 = ctx3.createLinearGradient(0, 0, 0, 200);
    grad3.addColorStop(0, 'rgba(139,211,221,0.3)');
    grad3.addColorStop(1, 'rgba(139,211,221,0.02)');
    new Chart(ctx3, {
        type: 'line', data: { labels: dailyData.map(d => d.date), datasets: [{ label: 'Pendapatan', data: dailyData.map(d => d.revenue), borderColor: '#8BD3DD', backgroundColor: grad3, fill: true, tension: 0.4, pointRadius: 2, borderWidth: 2 }] },
        options: { ...chartDefaults, scales: { x: { grid: gridStyle, ticks: { ...tickStyle, maxRotation: 45 } }, y: { grid: gridStyle, ticks: { ...tickStyle, callback: v => 'Rp ' + (v/1000).toFixed(0) + 'k' } } } }
    });

    const btData = <?php echo json_encode($businessTypes, 15, 512) ?>;
    const btColors = ['#DD6B20','#8BD3DD','#FAAE2B','#22A447','#FE98A3','#1A202C'];
    new Chart(document.getElementById('businessTypeChart').getContext('2d'), {
        type: 'pie', data: { labels: btData.map(d => d.business_type), datasets: [{ data: btData.map(d => d.count), backgroundColor: btColors, borderWidth: 2, borderColor: '#FFFFFF' }] },
        options: { responsive: true, plugins: { legend: { position: 'bottom', labels: { color: '#718096', font: { size: 11, family: 'IBM Plex Mono' }, boxWidth: 12, padding: 16 } } } }
    });

    anime({ targets: '.stat-card', opacity: [0, 1], translateY: [16, 0], delay: anime.stagger(80), duration: 500, easing: 'easeOutCubic' });
    anime({ targets: '.card-elevated', opacity: [0, 1], translateY: [12, 0], delay: anime.stagger(60, { start: 300 }), duration: 500, easing: 'easeOutCubic' });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\laragon\www\project-ai\resources\views/admin/analytics.blade.php ENDPATH**/ ?>