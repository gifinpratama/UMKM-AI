<?php $__env->startSection('title', 'Produk'); ?>
<?php $__env->startSection('page_title', 'Manajemen Produk'); ?>
<?php $__env->startSection('page_subtitle', 'Kelola semua produk bisnis Anda'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center justify-between mb-6">
    <form method="GET" class="flex items-center gap-3">
        <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-input w-64" placeholder="Cari produk...">
        <select name="category" class="form-input w-40" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($cat->id); ?>" <?php echo e(request('category') == $cat->id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </form>
    <a href="<?php echo e(route('seller.products.create')); ?>" class="btn-primary">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Tambah Produk
    </a>
</div>

<div class="card-elevated" style="overflow:hidden;">
    <table class="data-table">
        <thead><tr><th>Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Margin</th><th>Status</th><th>Aksi</th></tr></thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div style="width:40px;height:40px;border-radius:8px;background:var(--color-surface-soft);border:1px solid var(--color-border);display:flex;align-items:center;justify-content:center;color:var(--color-text-muted);flex-shrink:0;overflow:hidden;">
                            <?php if($product->image): ?>
                            <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="w-full h-full object-cover" loading="lazy" alt="<?php echo e($product->name); ?>">
                            <?php else: ?>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            <?php endif; ?>
                        </div>
                        <div>
                            <p style="font-family:var(--font-body);font-size:14px;font-weight:600;color:var(--color-text-primary);margin:0;"><?php echo e($product->name); ?></p>
                            <p style="font-family:var(--font-body);font-size:11px;color:var(--color-text-muted);margin:0;"><?php echo e($product->sku ?? '-'); ?></p>
                        </div>
                    </div>
                </td>
                <td><?php echo e($product->category->name ?? '-'); ?></td>
                <td style="font-weight:600;color:var(--color-orange);">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></td>
                <td>
                    <span class="badge <?php echo e($product->stock < 10 ? 'badge-warning' : 'badge-success'); ?>"><?php echo e($product->stock); ?></span>
                </td>
                <td style="font-weight:600;color:var(--color-success);"><?php echo e($product->profit_margin); ?>%</td>
                <td><span class="badge <?php echo e($product->is_active ? 'badge-success' : 'badge-danger'); ?>"><?php echo e($product->is_active ? 'Aktif' : 'Nonaktif'); ?></span></td>
                <td>
                    <div class="flex items-center gap-1">
                        <a href="<?php echo e(route('seller.products.edit', $product)); ?>" style="width:32px;height:32px;border-radius:6px;border:1px solid var(--color-border);display:inline-flex;align-items:center;justify-content:center;color:var(--color-text-muted);transition:all 0.2s;" onmouseover="this.style.background='var(--color-teal)';this.style.color='var(--color-text-primary)'" onmouseout="this.style.background='transparent';this.style.color='var(--color-text-muted)'">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </a>
                        <form method="POST" action="<?php echo e(route('seller.products.destroy', $product)); ?>" class="inline" onsubmit="return confirm('Hapus produk ini?')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button style="width:32px;height:32px;border-radius:6px;border:1px solid var(--color-border);background:transparent;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;color:var(--color-text-muted);transition:all 0.2s;" onmouseover="this.style.background='rgba(229,62,62,0.08)';this.style.color='var(--color-danger)'" onmouseout="this.style.background='transparent';this.style.color='var(--color-text-muted)'">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7" style="text-align:center;padding:32px;color:var(--color-text-muted);">Belum ada produk. <a href="<?php echo e(route('seller.products.create')); ?>" style="color:var(--color-orange);">Tambah sekarang</a></td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="mt-4"><?php echo e($products->withQueryString()->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\laragon\www\project-ai\resources\views/seller/products/index.blade.php ENDPATH**/ ?>