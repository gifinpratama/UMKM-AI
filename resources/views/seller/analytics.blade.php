@extends('layouts.app')
@section('title', 'Analisis AI')
@section('page_title', 'Analisis AI Bisnis')
@section('page_subtitle', 'Insight dan rekomendasi cerdas dari AI')

@section('content')
{{-- Quick Stats --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <div class="stat-card">
        <p class="text-xs text-dark-500 mb-1">Revenue Bulan Ini</p>
        <p class="text-xl font-bold text-white">Rp {{ number_format($stats['revenue_this_month'], 0, ',', '.') }}</p>
        <p class="text-xs {{ $stats['revenue_growth_percent'] >= 0 ? 'text-emerald-400' : 'text-red-400' }}">
            {{ $stats['revenue_growth_percent'] >= 0 ? '↑' : '↓' }} {{ abs($stats['revenue_growth_percent']) }}% vs bulan lalu
        </p>
    </div>
    <div class="stat-card">
        <p class="text-xs text-dark-500 mb-1">Rata-rata Transaksi</p>
        <p class="text-xl font-bold text-white">Rp {{ number_format($stats['avg_transaction_value'], 0, ',', '.') }}</p>
    </div>
    <div class="stat-card">
        <p class="text-xs text-dark-500 mb-1">Total Transaksi</p>
        <p class="text-xl font-bold text-white">{{ $stats['transactions_this_month'] }}</p>
    </div>
    <div class="stat-card">
        <p class="text-xs text-dark-500 mb-1">Produk Stok Rendah</p>
        <p class="text-xl font-bold {{ $stats['low_stock_products'] > 0 ? 'text-amber-400' : 'text-emerald-400' }}">{{ $stats['low_stock_products'] }}</p>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-6">
    {{-- Generate AI Analysis --}}
    <div class="glass-card p-6 border-indigo-500/20">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white">Analisis Bisnis AI</h3>
                <p class="text-[10px] text-dark-500">Powered by OpenRouter AI</p>
            </div>
        </div>

        <form method="POST" action="{{ route('seller.analytics.generate') }}">
            @csrf
            <button type="submit" class="btn-primary w-full justify-center mb-4" id="generateBtn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                Generate Analisis AI
            </button>
        </form>

        @if($latestSnapshot)
        <div class="mt-4 p-4 rounded-xl bg-white/[0.02] border border-white/5">
            <p class="text-[10px] text-dark-500 mb-2">Terakhir di-generate: {{ $latestSnapshot->generated_at->format('d M Y H:i') }}</p>
            @if(isset($latestSnapshot->insights['summary']))
                <p class="text-sm text-dark-300 leading-relaxed">{{ $latestSnapshot->insights['summary'] }}</p>
            @endif
            @if(isset($latestSnapshot->insights['health_score']))
                <div class="mt-3 flex items-center gap-3">
                    <span class="text-xs text-dark-500">Skor Kesehatan:</span>
                    <span class="text-lg font-bold gradient-text">{{ $latestSnapshot->insights['health_score'] }}/100</span>
                </div>
            @endif
            @if(isset($latestSnapshot->insights['trend']))
                <div class="mt-2 flex items-center gap-2">
                    <span class="text-xs text-dark-500">Tren:</span>
                    <span class="badge {{ $latestSnapshot->insights['trend'] === 'naik' ? 'badge-success' : ($latestSnapshot->insights['trend'] === 'turun' ? 'badge-danger' : 'badge-info') }}">
                        {{ ucfirst($latestSnapshot->insights['trend']) }}
                    </span>
                </div>
            @endif
            @if(isset($latestSnapshot->insights['recommendations']))
                <div class="mt-3">
                    <p class="text-xs text-dark-500 mb-2">Rekomendasi:</p>
                    <ul class="space-y-1">
                        @foreach(array_slice($latestSnapshot->insights['recommendations'], 0, 4) as $rec)
                        <li class="text-xs text-dark-400 flex items-start gap-2">
                            <span class="text-emerald-400 mt-0.5">•</span> {{ $rec }}
                        </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        @endif
    </div>

    {{-- AI Chat --}}
    <div class="glass-card p-6 flex flex-col" style="min-height: 500px;">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
            </div>
            <div>
                <h3 class="text-sm font-semibold text-white">AI Chat Assistant</h3>
                <p class="text-[10px] text-dark-500">Tanya apa saja tentang bisnis Anda</p>
            </div>
        </div>

        <div id="chatMessages" class="flex-1 overflow-y-auto space-y-3 mb-4 pr-2" style="max-height: 350px;">
            <div class="chat-bubble chat-bubble-ai">
                Halo! Saya UMKM.AI Assistant 👋 Saya bisa membantu menganalisis bisnis Anda. Coba tanyakan:
                <br>• "Bagaimana performa bisnis saya bulan ini?"
                <br>• "Produk apa yang paling laris?"
                <br>• "Saran untuk meningkatkan penjualan?"
            </div>
        </div>

        <div class="flex items-center gap-2">
            <input type="text" id="chatInput" class="form-input flex-1" placeholder="Ketik pertanyaan..." onkeydown="if(event.key==='Enter')sendChat()">
            <button onclick="sendChat()" class="btn-primary px-4 py-2.5" id="sendBtn">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
            </button>
        </div>
    </div>
</div>

{{-- Top Products --}}
@if(!empty($stats['top_products']))
<div class="mt-6 glass-card p-6">
    <h3 class="text-sm font-semibold text-white mb-4">Produk Terlaris Bulan Ini</h3>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
        @foreach($stats['top_products'] as $name => $qty)
        <div class="p-3 rounded-lg bg-white/[0.02] border border-white/5 text-center">
            <p class="text-sm font-medium text-dark-200">{{ $name }}</p>
            <p class="text-lg font-bold gradient-text mt-1">{{ $qty }}</p>
            <p class="text-[10px] text-dark-500">terjual</p>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection

@push('scripts')
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
    loading.innerHTML = '<div class="flex items-center gap-2"><div class="w-2 h-2 bg-indigo-400 rounded-full animate-pulse"></div><div class="w-2 h-2 bg-indigo-400 rounded-full animate-pulse" style="animation-delay:0.2s"></div><div class="w-2 h-2 bg-indigo-400 rounded-full animate-pulse" style="animation-delay:0.4s"></div></div>';
    messages.appendChild(loading);
    messages.scrollTop = messages.scrollHeight;

    try {
        const response = await fetch('{{ route("seller.analytics.chat") }}', {
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
@endpush
