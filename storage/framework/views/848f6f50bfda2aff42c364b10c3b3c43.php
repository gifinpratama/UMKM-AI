<?php $__env->startSection('title', 'Kelola Seller'); ?>
<?php $__env->startSection('page_title', 'Kelola Seller UMKM'); ?>
<?php $__env->startSection('page_subtitle', 'Manajemen semua akun seller dan database'); ?>

<?php $__env->startSection('content'); ?>
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;gap:16px;">
    <form method="GET" style="display:flex;align-items:center;gap:12px;">
        <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-input" style="width:260px;" placeholder="Cari seller...">
        <select name="status" class="form-input" style="width:160px;" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Aktif</option>
            <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>Tidak Aktif</option>
        </select>
        <button type="submit" class="btn-secondary">Cari</button>
    </form>
    <a href="<?php echo e(route('admin.sellers.create')); ?>" class="btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
        Tambah Seller & Database
    </a>
</div>

<div class="card-elevated" style="padding:0;overflow:hidden;">
    <div class="overflow-x-auto">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Seller</th>
                    <th>Bisnis</th>
                    <th>Database</th>
                    <th>Status</th>
                    <th>Terdaftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $sellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $seller): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-sm font-bold shrink-0">
                                <?php echo e(strtoupper(substr($seller->name, 0, 1))); ?>

                            </div>
                            <div>
                                <p class="font-medium text-dark-200"><?php echo e($seller->name); ?></p>
                                <p class="text-xs text-dark-500"><?php echo e($seller->email); ?></p>
                            </div>
                        </div>
                    </td>
                    <td>
                        <p class="text-dark-300"><?php echo e($seller->business_name); ?></p>
                        <p class="text-xs text-dark-500"><?php echo e($seller->business_type); ?></p>
                    </td>
                    <td>
                        <?php if($seller->umkmDatabase): ?>
                        <span class="badge badge-info"><?php echo e($seller->umkmDatabase->db_name); ?></span>
                        <?php else: ?>
                        <span class="badge badge-warning">Belum ada</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge <?php echo e($seller->is_active ? 'badge-success' : 'badge-danger'); ?>">
                            <?php echo e($seller->is_active ? 'Aktif' : 'Nonaktif'); ?>

                        </span>
                    </td>
                    <td class="text-xs text-dark-500"><?php echo e($seller->created_at->format('d M Y')); ?></td>
                    <td>
                        <div class="flex items-center gap-2">
                            <a href="<?php echo e(route('admin.sellers.show', $seller)); ?>" class="p-1.5 rounded-lg hover:bg-white/5 text-dark-400 hover:text-indigo-400 transition" title="Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <form method="POST" action="<?php echo e(route('admin.sellers.toggleStatus', $seller)); ?>" class="inline">
                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="p-1.5 rounded-lg hover:bg-white/5 text-dark-400 hover:text-amber-400 transition" title="<?php echo e($seller->is_active ? 'Nonaktifkan' : 'Aktifkan'); ?>">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                </button>
                            </form>
                            <form method="POST" action="<?php echo e(route('admin.sellers.destroy', $seller)); ?>" class="inline" onsubmit="return confirm('Yakin hapus seller ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="p-1.5 rounded-lg hover:bg-white/5 text-dark-400 hover:text-red-400 transition" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr><td colspan="6" class="text-center py-8 text-dark-500">Belum ada seller terdaftar. <a href="<?php echo e(route('admin.sellers.create')); ?>" class="text-indigo-400">Tambah sekarang</a></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4"><?php echo e($sellers->links()); ?></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\laragon\www\project-ai\resources\views/admin/sellers/index.blade.php ENDPATH**/ ?>