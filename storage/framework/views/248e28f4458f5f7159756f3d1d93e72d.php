<?php $__env->startSection('title', 'Dashboard Admin'); ?>
<?php $__env->startSection('page_title', 'Dashboard Admin'); ?>
<?php $__env->startSection('page_subtitle', 'Overview semua UMKM yang terdaftar'); ?>

<?php $__env->startSection('content'); ?>

<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">
    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
            <div style="width:40px;height:40px;border-radius:10px;background:rgba(139,211,221,0.15);display:flex;align-items:center;justify-content:center;">
                <svg width="20" height="20" fill="none" stroke="var(--color-teal)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="badge badge-success">Aktif: <?php echo e($activeSellers); ?></span>
        </div>
        <p style="font-family:var(--font-display);font-size:22px;font-weight:800;color:var(--color-text-primary);margin:0;"><?php echo e($totalSellers); ?></p>
        <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">Total Seller UMKM</p>
    </div>

    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
            <div style="width:40px;height:40px;border-radius:10px;background:rgba(34,164,71,0.12);display:flex;align-items:center;justify-content:center;">
                <svg width="20" height="20" fill="none" stroke="var(--color-success)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <p style="font-family:var(--font-display);font-size:22px;font-weight:800;color:var(--color-text-primary);margin:0;">Rp <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></p>
        <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">Total Revenue</p>
    </div>

    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
            <div style="width:40px;height:40px;border-radius:10px;background:rgba(221,107,32,0.12);display:flex;align-items:center;justify-content:center;">
                <svg width="20" height="20" fill="none" stroke="var(--color-orange)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
        </div>
        <p style="font-family:var(--font-display);font-size:22px;font-weight:800;color:var(--color-text-primary);margin:0;"><?php echo e(number_format($totalTransactions)); ?></p>
        <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">Total Transaksi</p>
    </div>

    <div class="stat-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
            <div style="width:40px;height:40px;border-radius:10px;background:rgba(250,174,43,0.12);display:flex;align-items:center;justify-content:center;">
                <svg width="20" height="20" fill="none" stroke="var(--color-golden)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/></svg>
            </div>
        </div>
        <p style="font-family:var(--font-display);font-size:22px;font-weight:800;color:var(--color-text-primary);margin:0;"><?php echo e($totalDatabases); ?></p>
        <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:4px 0 0;">Database Aktif</p>
    </div>
</div>

<div style="display:grid;grid-template-columns:2fr 1fr;gap:16px;">
    
    <div class="card-elevated">
        <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0 0 16px;">Revenue Bulanan (6 Bulan Terakhir)</h3>
        <canvas id="revenueChart" height="200"></canvas>
    </div>

    
    <div class="card-elevated">
        <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0 0 16px;">Top Seller by Revenue</h3>
        <div style="display:flex;flex-direction:column;gap:10px;">
            <?php $__empty_1 = true; $__currentLoopData = $topSellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="display:flex;align-items:center;gap:10px;padding:8px 10px;border-radius:8px;background:var(--color-surface-soft);">
                <span style="font-family:var(--font-body);font-size:12px;font-weight:600;color:var(--color-text-muted);width:20px;"><?php echo e($index + 1); ?></span>
                <div style="width:32px;height:32px;border-radius:8px;background:var(--color-teal);display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-weight:800;color:var(--color-text-primary);font-size:12px;flex-shrink:0;">
                    <?php echo e(strtoupper(substr($seller->business_name ?? $seller->name, 0, 1))); ?>

                </div>
                <div style="flex:1;min-width:0;">
                    <p style="font-family:var(--font-body);font-size:13px;font-weight:600;color:var(--color-text-primary);margin:0;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?php echo e($seller->business_name ?? $seller->name); ?></p>
                    <p style="font-family:var(--font-body);font-size:11px;color:var(--color-text-muted);margin:0;">Rp <?php echo e(number_format($seller->total_revenue, 0, ',', '.')); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="font-family:var(--font-body);font-size:14px;color:var(--color-text-muted);text-align:center;padding:16px;">Belum ada data seller</p>
            <?php endif; ?>
        </div>
    </div>
</div>


<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:24px;">
    <div class="card-elevated">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
            <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0;">Seller Terbaru</h3>
            <a href="<?php echo e(route('admin.sellers.create')); ?>" class="btn-primary btn-sm">+ Tambah</a>
        </div>
        <div style="overflow-x:auto;">
            <table class="data-table">
                <thead><tr><th>Nama</th><th>Bisnis</th><th>Status</th><th>Tanggal</th></tr></thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $recentSellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td style="font-weight:600;"><?php echo e($seller->name); ?></td>
                        <td><?php echo e($seller->business_name); ?></td>
                        <td><span class="badge <?php echo e($seller->is_active ? 'badge-success' : 'badge-danger'); ?>"><?php echo e($seller->is_active ? 'Aktif' : 'Nonaktif'); ?></span></td>
                        <td style="color:var(--color-text-muted);font-size:12px;"><?php echo e($seller->created_at->format('d M Y')); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="4" style="text-align:center;color:var(--color-text-muted);">Belum ada seller</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-elevated">
        <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0 0 16px;">Aktivitas Terbaru</h3>
        <div style="display:flex;flex-direction:column;gap:10px;">
            <?php $__empty_1 = true; $__currentLoopData = $recentActivity; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div style="display:flex;align-items:flex-start;gap:10px;padding:8px 0;border-bottom:1px solid var(--color-border);">
                <div style="width:8px;height:8px;border-radius:50%;background:var(--color-orange);margin-top:6px;flex-shrink:0;"></div>
                <div>
                    <p style="font-family:var(--font-body);font-size:13px;color:var(--color-text-primary);margin:0 0 2px;"><?php echo e($activity->description); ?></p>
                    <p style="font-family:var(--font-body);font-size:11px;color:var(--color-text-muted);margin:0;"><?php echo e($activity->user->name ?? 'System'); ?> · <?php echo e($activity->created_at->diffForHumans()); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p style="font-family:var(--font-body);font-size:14px;color:var(--color-text-muted);text-align:center;padding:16px;">Belum ada aktivitas</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Revenue chart
    const revenueData = <?php echo json_encode($monthlyRevenue, 15, 512) ?>;
    const ctx = document.getElementById('revenueChart').getContext('2d');
    
    const gradient = ctx.createLinearGradient(0, 0, 0, 200);
    gradient.addColorStop(0, 'rgba(221,107,32,0.25)');
    gradient.addColorStop(1, 'rgba(221,107,32,0.02)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: revenueData.map(d => d.month),
            datasets: [{
                label: 'Revenue',
                data: revenueData.map(d => d.revenue),
                borderColor: '#DD6B20',
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#DD6B20',
                pointBorderColor: '#FFFFFF',
                pointBorderWidth: 2,
                pointRadius: 4,
                borderWidth: 2,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1A202C',
                    titleColor: '#E2E8F0',
                    bodyColor: '#718096',
                    borderColor: 'rgba(221,107,32,0.3)',
                    borderWidth: 1,
                    cornerRadius: 8,
                    callbacks: { label: (ctx) => 'Rp ' + ctx.parsed.y.toLocaleString('id-ID') }
                }
            },
            scales: {
                x: { grid: { color: '#E2E8F0' }, ticks: { color: '#718096', font: { size: 11, family: 'IBM Plex Mono' } } },
                y: { grid: { color: '#E2E8F0' }, ticks: { color: '#718096', font: { size: 11, family: 'IBM Plex Mono' }, callback: v => 'Rp ' + (v/1000000).toFixed(1) + 'jt' } }
            }
        }
    });

    // Stat cards animation
    anime({
        targets: '.stat-card',
        opacity: [0, 1],
        translateY: [20, 0],
        scale: [0.95, 1],
        delay: anime.stagger(100),
        duration: 600,
        easing: 'easeOutCubic'
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\laragon\www\project-ai\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>