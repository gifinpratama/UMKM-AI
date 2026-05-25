<?php $__env->startSection('title', 'Analisis AI'); ?>
<?php $__env->startSection('page_title', 'Analisis AI Bisnis'); ?>
<?php $__env->startSection('page_subtitle', 'Insight dan rekomendasi cerdas dari AI'); ?>

<?php $__env->startSection('content'); ?>

<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px;">
    <div class="stat-card">
        <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:0 0 4px;">Revenue Bulan Ini</p>
        <p style="font-family:var(--font-display);font-size:20px;font-weight:800;color:var(--color-text-primary);margin:0;">Rp <?php echo e(number_format($stats['revenue_this_month'], 0, ',', '.')); ?></p>
        <p style="font-family:var(--font-body);font-size:12px;color:<?php echo e($stats['revenue_growth_percent'] >= 0 ? 'var(--color-success)' : 'var(--color-danger)'); ?>;margin:4px 0 0;">
            <?php echo e($stats['revenue_growth_percent'] >= 0 ? '↑' : '↓'); ?> <?php echo e(abs($stats['revenue_growth_percent'])); ?>% vs bulan lalu
        </p>
    </div>
    <div class="stat-card">
        <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:0 0 4px;">Rata-rata Transaksi</p>
        <p style="font-family:var(--font-display);font-size:20px;font-weight:800;color:var(--color-text-primary);margin:0;">Rp <?php echo e(number_format($stats['avg_transaction_value'], 0, ',', '.')); ?></p>
    </div>
    <div class="stat-card">
        <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:0 0 4px;">Total Transaksi</p>
        <p style="font-family:var(--font-display);font-size:20px;font-weight:800;color:var(--color-text-primary);margin:0;"><?php echo e($stats['transactions_this_month']); ?></p>
    </div>
    <div class="stat-card">
        <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:0 0 4px;">Stok Rendah</p>
        <p style="font-family:var(--font-display);font-size:20px;font-weight:800;color:<?php echo e($stats['low_stock_products'] > 0 ? 'var(--color-golden)' : 'var(--color-success)'); ?>;margin:0;"><?php echo e($stats['low_stock_products']); ?></p>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
    
    <div class="card-elevated" style="border-left:4px solid var(--color-orange);">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
            <div style="width:40px;height:40px;border-radius:10px;background:var(--color-orange);display:flex;align-items:center;justify-content:center;box-shadow:var(--shadow-orange);">
                <svg width="20" height="20" fill="none" stroke="#fff" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
            </div>
            <div>
                <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0;">Analisis Bisnis AI</h3>
                <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:0;">Powered by OpenRouter AI</p>
            </div>
        </div>

        <form method="POST" action="<?php echo e(route('seller.analytics.generate')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn-primary w-full justify-center mb-4" id="generateBtn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Generate Analisis AI
            </button>
        </form>

        <?php if($latestSnapshot): ?>
        <div class="card-surface" style="margin-top:12px;">
            <p style="font-family:var(--font-body);font-size:11px;color:var(--color-text-muted);margin:0 0 8px;">Terakhir: <?php echo e($latestSnapshot->generated_at->format('d M Y H:i')); ?></p>
            <?php if(isset($latestSnapshot->insights['summary'])): ?>
                <p style="font-family:var(--font-body);font-size:13px;color:var(--color-text-primary);line-height:1.6;margin:0 0 8px;"><?php echo e($latestSnapshot->insights['summary']); ?></p>
            <?php endif; ?>
            <?php if(isset($latestSnapshot->insights['health_score'])): ?>
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:6px;">
                    <span style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);">Skor Kesehatan:</span>
                    <span style="font-family:var(--font-display);font-size:18px;font-weight:800;color:var(--color-orange);"><?php echo e($latestSnapshot->insights['health_score']); ?>/100</span>
                </div>
            <?php endif; ?>
            <?php if(isset($latestSnapshot->insights['trend'])): ?>
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                    <span style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);">Tren:</span>
                    <span class="badge <?php echo e($latestSnapshot->insights['trend'] === 'naik' ? 'badge-success' : ($latestSnapshot->insights['trend'] === 'turun' ? 'badge-danger' : 'badge-info')); ?>">
                        <?php echo e(ucfirst($latestSnapshot->insights['trend'])); ?>

                    </span>
                </div>
            <?php endif; ?>
            <?php if(isset($latestSnapshot->insights['recommendations'])): ?>
                <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:0 0 4px;">Rekomendasi:</p>
                <ul style="margin:0;padding-left:16px;">
                    <?php $__currentLoopData = array_slice($latestSnapshot->insights['recommendations'], 0, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li style="font-family:var(--font-body);font-size:13px;color:var(--color-text-primary);margin-bottom:4px;"><?php echo e($rec); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    
    <div class="card-elevated" style="display:flex;flex-direction:column;min-height:500px;border-left:4px solid var(--color-teal);">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:16px;">
            <div style="width:40px;height:40px;border-radius:10px;background:var(--color-teal);display:flex;align-items:center;justify-content:center;box-shadow:var(--shadow-teal);">
                <svg width="20" height="20" fill="none" stroke="var(--color-text-primary)" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
            </div>
            <div>
                <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0;">AI Chat Assistant</h3>
                <p style="font-family:var(--font-body);font-size:12px;color:var(--color-text-muted);margin:0;">Tanya apa saja tentang bisnis Anda</p>
            </div>
        </div>

        <div id="chatMessages" style="flex:1;overflow-y:auto;display:flex;flex-direction:column;gap:10px;margin-bottom:16px;padding-right:4px;max-height:350px;">
            <div class="chat-bubble chat-bubble-ai">
                Halo! Saya UMKM-AI Assistant 👋 Saya bisa membantu menganalisis bisnis Anda. Coba tanyakan:<br>
                • "Bagaimana performa bisnis saya bulan ini?"<br>
                • "Produk apa yang paling laris?"<br>
                • "Saran untuk meningkatkan penjualan?"
            </div>
        </div>

        <div style="display:flex;gap:8px;">
            <input type="text" id="chatInput" class="form-input" style="flex:1;" placeholder="Ketik pertanyaan..." onkeydown="if(event.key==='Enter')sendChat()">
            <button onclick="sendChat()" class="btn-primary" style="padding:12px 16px;" id="sendBtn">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
            </button>
        </div>
    </div>
</div>


<?php if(!empty($stats['top_products'])): ?>
<div class="card-elevated" style="margin-top:24px;">
    <h3 style="font-family:var(--font-display);font-size:16px;font-weight:800;color:var(--color-text-primary);margin:0 0 16px;">Produk Terlaris Bulan Ini</h3>
    <div style="display:grid;grid-template-columns:repeat(5,1fr);gap:12px;">
        <?php $__currentLoopData = $stats['top_products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $qty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card-surface" style="text-align:center;">
            <p style="font-family:var(--font-body);font-size:13px;font-weight:600;color:var(--color-text-primary);margin:0 0 4px;"><?php echo e($name); ?></p>
            <p style="font-family:var(--font-display);font-size:20px;font-weight:800;color:var(--color-orange);margin:0;"><?php echo e($qty); ?></p>
            <p style="font-family:var(--font-body);font-size:11px;color:var(--color-text-muted);margin:2px 0 0;">terjual</p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function formatAIResponse(text) {
    if (!text) return '';
    let html = text;

    // Escape HTML entities first (prevent XSS)
    html = html.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

    // Code blocks (```)
    html = html.replace(/```(\w*)\n?([\s\S]*?)```/g, '<pre><code>$2</code></pre>');

    // Inline code
    html = html.replace(/`([^`]+)`/g, '<code>$1</code>');

    // Headers (### → h3, ## → h2, # → h1)
    html = html.replace(/^####\s+(.+)$/gm, '<h4>$1</h4>');
    html = html.replace(/^###\s+(.+)$/gm, '<h3>$1</h3>');
    html = html.replace(/^##\s+(.+)$/gm, '<h2>$1</h2>');
    html = html.replace(/^#\s+(.+)$/gm, '<h1>$1</h1>');

    // Bold (**text** or __text__)
    html = html.replace(/\*\*([^*]+)\*\*/g, '<strong>$1</strong>');
    html = html.replace(/__([^_]+)__/g, '<strong>$1</strong>');

    // Italic (*text* or _text_)
    html = html.replace(/\*([^*]+)\*/g, '<em>$1</em>');
    html = html.replace(/_([^_]+)_/g, '<em>$1</em>');

    // Horizontal rule
    html = html.replace(/^---$/gm, '<hr>');

    // Blockquote
    html = html.replace(/^>\s+(.+)$/gm, '<blockquote>$1</blockquote>');

    // Unordered list items (- or •)
    html = html.replace(/^[\-•]\s+(.+)$/gm, '<li>$1</li>');

    // Ordered list items (1. 2. etc.)
    html = html.replace(/^\d+\.\s+(.+)$/gm, '<li>$1</li>');

    // Wrap consecutive <li> in <ul>
    html = html.replace(/((?:<li>.*<\/li>\n?)+)/g, '<ul>$1</ul>');

    // Convert remaining newlines to paragraphs
    // Split by double newlines for paragraphs
    const parts = html.split(/\n{2,}/);
    html = parts.map(part => {
        part = part.trim();
        if (!part) return '';
        // Don't wrap if already an HTML block element
        if (/^<(h[1-4]|ul|ol|pre|blockquote|hr|table|div)/.test(part)) return part;
        // Don't wrap empty lines
        if (!part.length) return '';
        // Replace single newlines with <br>
        part = part.replace(/\n/g, '<br>');
        return '<p>' + part + '</p>';
    }).join('');

    // Clean up: merge consecutive blockquotes
    html = html.replace(/<\/blockquote>\s*<blockquote>/g, '<br>');

    return html;
}

async function sendChat() {
    const input = document.getElementById('chatInput');
    const message = input.value.trim();
    if (!message) return;

    const messages = document.getElementById('chatMessages');

    // Add user message
    const userBubble = document.createElement('div');
    userBubble.className = 'chat-bubble chat-bubble-user';
    userBubble.textContent = message;
    messages.appendChild(userBubble);
    input.value = '';
    messages.scrollTop = messages.scrollHeight;

    anime({ targets: userBubble, opacity: [0, 1], translateX: [20, 0], duration: 300, easing: 'easeOutCubic' });

    // Loading
    const loading = document.createElement('div');
    loading.className = 'chat-bubble chat-bubble-ai';
    loading.innerHTML = '<div style="display:flex;align-items:center;gap:6px;"><div style="width:8px;height:8px;border-radius:50%;background:var(--color-teal);animation:pulse 1s infinite;"></div><div style="width:8px;height:8px;border-radius:50%;background:var(--color-teal);animation:pulse 1s 0.2s infinite;"></div><div style="width:8px;height:8px;border-radius:50%;background:var(--color-teal);animation:pulse 1s 0.4s infinite;"></div></div>';
    messages.appendChild(loading);
    messages.scrollTop = messages.scrollHeight;

    try {
        const response = await fetch('<?php echo e(route("seller.analytics.chat")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ message }),
        });
        const data = await response.json();
        loading.remove();

        const aiBubble = document.createElement('div');
        aiBubble.className = 'chat-bubble chat-bubble-ai';
        aiBubble.innerHTML = '<div class="ai-content">' + formatAIResponse(data.response) + '</div>';
        messages.appendChild(aiBubble);
        messages.scrollTop = messages.scrollHeight;

        anime({ targets: aiBubble, opacity: [0, 1], translateX: [-20, 0], duration: 300, easing: 'easeOutCubic' });
    } catch (err) {
        loading.remove();
        const errBubble = document.createElement('div');
        errBubble.className = 'chat-bubble chat-bubble-ai';
        errBubble.innerHTML = '<div class="ai-content"><p>Maaf, terjadi kesalahan. Silakan coba lagi.</p></div>';
        messages.appendChild(errBubble);
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\laragon\www\project-ai\resources\views/seller/analytics.blade.php ENDPATH**/ ?>