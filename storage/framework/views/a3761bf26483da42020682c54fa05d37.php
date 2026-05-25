<?php $__env->startSection('title', 'UMKM-AI - Platform Analisis & Digitalisasi UMKM Berbasis AI'); ?>
<?php $__env->startSection('meta_description', 'Transform bisnis UMKM Anda dengan kecerdasan buatan. Analisis penjualan, prediksi revenue, dan rekomendasi produk otomatis.'); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="particles-bg" id="particles"></div>

    
    <nav id="main-nav" class="fixed left-0 right-0 z-50 border-b border-white/5" style="top:42px;">
        <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
            <a href="/" class="flex items-center gap-3">
                <div
                    class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg shadow-indigo-500/25">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-xl font-bold gradient-text">UMKM-AI</span>
            </a>

            <div class="hidden md:flex items-center gap-8">
                <a href="#features" class="text-sm text-dark-400 hover:text-white transition">Fitur</a>
                <a href="#how-it-works" class="text-sm text-dark-400 hover:text-white transition">Cara Kerja</a>
                <a href="#stats" class="text-sm text-dark-400 hover:text-white transition">Statistik</a>
                <a href="#about" class="text-sm text-dark-400 hover:text-white transition">Tentang</a>
            </div>

            <div class="flex items-center gap-3">
                <a href="<?php echo e(route('login')); ?>" class="btn-secondary text-sm py-2 px-4">Masuk</a>
                <a href="<?php echo e(route('register')); ?>" class="btn-primary text-sm py-2 px-4">Daftar Gratis</a>
            </div>
        </div>
    </nav>

    
    <section class="flex items-center justify-center pt-20 overflow-hidden">
        
        <div id="orb-1" class="absolute w-[600px] h-[600px] rounded-full bg-indigo-600/20 blur-[120px] -top-40 -left-40">
        </div>
        <div id="orb-2"
            class="absolute w-[500px] h-[500px] rounded-full bg-purple-600/15 blur-[100px] -bottom-40 -right-40"></div>
        <div id="orb-3"
            class="absolute w-[300px] h-[300px] rounded-full bg-emerald-600/10 blur-[80px] top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
        </div>

        <div class="relative z-9 max-w-7xl mx-auto px-6 text-center">
            
            <div id="hero-badge"
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-xs font-medium mb-8 opacity-0">
                <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                Platform AI untuk UMKM Indonesia
            </div>

            
            <h1 id="hero-title" class="text-4xl md:text-6xl lg:text-7xl font-black leading-tight mb-6">
                <span class="text-black opacity-0 hero-word">Digitalkan</span>
                <span class="text-black opacity-0 hero-word">Bisnis</span>
                <span class="opacity-0 hero-word gradient-text">UMKM</span>
                <br>
                <span class="text-black opacity-0 hero-word">Anda</span>
                <span class="text-black opacity-0 hero-word">dengan</span>
                <span class="opacity-0 hero-word gradient-text-accent">AI</span>
            </h1>

            
            <p id="hero-subtitle"
                class="text-lg md:text-xl text-dark-400 max-w-2xl mx-auto mb-10 leading-relaxed opacity-0">
                Analisis penjualan otomatis, prediksi pendapatan, rekomendasi produk cerdas,
                dan insight pelanggan — semua dalam satu platform yang mudah digunakan.
            </p>

            
            <div id="hero-cta" class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-16 opacity-0">
                <a href="<?php echo e(route('register')); ?>" class="btn-primary px-8 py-3.5 text-base">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Mulai Sekarang — Gratis
                </a>
                <a href="#features" class="btn-secondary px-8 py-3.5 text-base">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Lihat Demo
                </a>
            </div>

        </div>
    </section>

    
    <section id="features" class="relative py-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <p class="text-indigo-400 text-sm font-semibold mb-3 feature-animate">FITUR UNGGULAN</p>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 feature-animate">Semua yang Bisnis UMKM Anda
                    Butuhkan</h2>
                <p class="text-dark-400 max-w-2xl mx-auto feature-animate">Platform lengkap untuk mengelola, menganalisis,
                    dan mengembangkan bisnis UMKM Anda dengan bantuan kecerdasan buatan.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                <div class="glass-card p-6 feature-card">
                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500/20 to-indigo-600/20 flex items-center justify-center mb-4 border border-indigo-500/20">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Analisis AI Cerdas</h3>
                    <p class="text-sm text-dark-400 leading-relaxed">AI menganalisis data penjualan Anda secara otomatis dan
                        memberikan insight, tren, serta prediksi pendapatan yang akurat.</p>
                </div>

                
                <div class="glass-card p-6 feature-card">
                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500/20 to-emerald-600/20 flex items-center justify-center mb-4 border border-emerald-500/20">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Dashboard Real-time</h3>
                    <p class="text-sm text-dark-400 leading-relaxed">Pantau penjualan, stok, dan performa bisnis secara
                        real-time dengan dashboard interaktif yang mudah dipahami.</p>
                </div>

                
                <div class="glass-card p-6 feature-card">
                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500/20 to-purple-600/20 flex items-center justify-center mb-4 border border-purple-500/20">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Manajemen Produk</h3>
                    <p class="text-sm text-dark-400 leading-relaxed">Kelola inventori dengan mudah. Notifikasi stok rendah
                        otomatis dan rekomendasi restock dari AI.</p>
                </div>

                
                <div class="glass-card p-6 feature-card">
                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-amber-500/20 to-amber-600/20 flex items-center justify-center mb-4 border border-amber-500/20">
                        <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Segmentasi Pelanggan</h3>
                    <p class="text-sm text-dark-400 leading-relaxed">AI secara otomatis mengelompokkan pelanggan dan
                        memberikan strategi pemasaran per segmen.</p>
                </div>

                
                <div class="glass-card p-6 feature-card">
                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-cyan-500/20 to-cyan-600/20 flex items-center justify-center mb-4 border border-cyan-500/20">
                        <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">AI Chat Assistant</h3>
                    <p class="text-sm text-dark-400 leading-relaxed">Tanya apa saja tentang bisnis Anda. AI assistant siap
                        memberikan jawaban dan saran bisnis 24/7.</p>
                </div>

                
                <div class="glass-card p-6 feature-card">
                    <div
                        class="w-12 h-12 rounded-xl bg-gradient-to-br from-rose-500/20 to-rose-600/20 flex items-center justify-center mb-4 border border-rose-500/20">
                        <svg class="w-6 h-6 text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Multi-Database</h3>
                    <p class="text-sm text-dark-400 leading-relaxed">Admin dapat membuat database terpisah untuk setiap
                        UMKM. Data aman dan terisolasi per bisnis.</p>
                </div>
            </div>
        </div>
    </section>

    
    <section id="how-it-works" class="relative py-24 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-transparent via-indigo-950/20 to-transparent"></div>
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <p class="text-indigo-400 text-sm font-semibold mb-3 step-animate">CARA KERJA</p>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 step-animate">3 Langkah Mudah untuk Memulai</h2>
                <p class="text-dark-400 max-w-2xl mx-auto step-animate">Mulai digitalisasi bisnis UMKM Anda dalam hitungan
                    menit.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="relative text-center step-card">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-indigo-600 to-indigo-700 flex items-center justify-center mx-auto mb-6 shadow-lg shadow-indigo-500/25">
                        <span class="text-2xl font-black text-white">1</span>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-3">Daftar Akun</h3>
                    <p class="text-sm text-dark-400 leading-relaxed">Buat akun gratis dan masukkan informasi bisnis UMKM
                        Anda. Proses cepat, tanpa biaya.</p>
                    
                    <div
                        class="hidden md:block absolute top-8 left-[60%] w-[80%] h-px bg-gradient-to-r from-indigo-500/50 to-transparent">
                    </div>
                </div>

                <div class="relative text-center step-card">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-600 to-emerald-700 flex items-center justify-center mx-auto mb-6 shadow-lg shadow-emerald-500/25">
                        <span class="text-2xl font-black text-white">2</span>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-3">Input Data Bisnis</h3>
                    <p class="text-sm text-dark-400 leading-relaxed">Tambahkan produk, catat transaksi, dan kelola pelanggan
                        melalui dashboard yang intuitif.</p>
                    <div
                        class="hidden md:block absolute top-8 left-[60%] w-[80%] h-px bg-gradient-to-r from-emerald-500/50 to-transparent">
                    </div>
                </div>

                <div class="text-center step-card">
                    <div
                        class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-600 to-purple-700 flex items-center justify-center mx-auto mb-6 shadow-lg shadow-purple-500/25">
                        <span class="text-2xl font-black text-white">3</span>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-3">Dapatkan Insight AI</h3>
                    <p class="text-sm text-dark-400 leading-relaxed">AI akan menganalisis data dan memberikan rekomendasi
                        cerdas untuk mengembangkan bisnis Anda.</p>
                </div>
            </div>
        </div>
    </section>

    
    <section id="stats" class="relative py-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="glass-card p-12 text-center stat-section-animate">
                <div
                    style="display:inline-flex;align-items:center;gap:8px;background:rgba(250,174,43,0.15);border:2px solid #FAAE2B;border-radius:8px;padding:6px 16px;margin-bottom:24px;">
                    <span
                        style="width:8px;height:8px;border-radius:50%;background:#FAAE2B;display:inline-block;animation:pulse 1.5s infinite;"></span>
                    <span
                        style="font-family:'Space Grotesk',sans-serif;font-size:12px;font-weight:700;color:#FAAE2B;letter-spacing:0.06em;">TAHAP
                        UJI COBA</span>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                    Hadir untuk Seluruh UMKM di Indonesia
                </h2>
                <p class="text-dark-400 max-w-2xl mx-auto text-lg leading-relaxed">
                    Platform ini saat ini dalam tahap uji coba (<em>beta</em>). Kami sedang mengembangkan
                    fitur-fitur terbaik untuk mendukung pertumbuhan UMKM Indonesia.
                    Bergabunglah lebih awal dan berikan masukan Anda.
                </p>
            </div>
        </div>
    </section>


    
    <section id="about" class="relative py-24">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="about-animate">
                    <p class="text-indigo-400 text-sm font-semibold mb-3">TENTANG UMKM-AI</p>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Membangun Masa Depan UMKM Indonesia yang
                        Lebih Cerdas</h2>
                    <p class="text-dark-400 mb-6 leading-relaxed">
                        UMKM-AI adalah platform sistem analisis dan digitalisasi yang dirancang khusus untuk Usaha Mikro,
                        Kecil, dan Menengah (UMKM) di Indonesia. Kami percaya bahwa setiap bisnis, sekecil apapun, berhak
                        mendapatkan akses ke teknologi kecerdasan buatan untuk membantu mereka tumbuh.
                    </p>
                    <p class="text-dark-400 mb-8 leading-relaxed">
                        Dengan memanfaatkan AI terkini, platform kami mampu menganalisis pola penjualan, memprediksi tren
                        pasar, memberikan rekomendasi produk, dan membantu pemilik UMKM membuat keputusan bisnis yang lebih
                        tepat berdasarkan data — bukan hanya intuisi.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <div class="flex items-center gap-2 text-sm text-dark-300">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Gratis untuk memulai
                        </div>
                        <div class="flex items-center gap-2 text-sm text-dark-300">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Data aman & terenkripsi
                        </div>
                        <div class="flex items-center gap-2 text-sm text-dark-300">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Support 24/7
                        </div>
                        <div class="flex items-center gap-2 text-sm text-dark-300">
                            <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            AI Terkini
                        </div>
                    </div>
                </div>

                <div class="about-animate">
                    <div class="glass-card p-6 space-y-4">
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-white/[0.03] border border-white/5">
                            <div class="w-10 h-10 rounded-lg bg-indigo-500/20 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white text-sm">Visi Kami</h4>
                                <p class="text-xs text-dark-400 mt-1">Menjadi platform digitalisasi UMKM terdepan di Asia
                                    Tenggara dengan teknologi AI terbaik.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-white/[0.03] border border-white/5">
                            <div class="w-10 h-10 rounded-lg bg-emerald-500/20 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white text-sm">Misi Kami</h4>
                                <p class="text-xs text-dark-400 mt-1">Membantu 10 juta UMKM Indonesia bertransformasi
                                    digital dan meningkatkan pendapatan 3x lipat.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 p-4 rounded-xl bg-white/[0.03] border border-white/5">
                            <div class="w-10 h-10 rounded-lg bg-purple-500/20 flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-white text-sm">Keamanan Data</h4>
                                <p class="text-xs text-dark-400 mt-1">Data bisnis Anda terenkripsi dan dilindungi dengan
                                    standar keamanan tertinggi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    <section class="relative py-24">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <div class="glass-card p-12 glow-primary relative overflow-hidden cta-animate">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/10 to-purple-600/10"></div>
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Siap Mengembangkan Bisnis UMKM Anda?</h2>
                    <p class="text-dark-400 mb-8 max-w-lg mx-auto">Bergabung dengan ribuan UMKM lainnya yang sudah merasakan
                        manfaat analisis bisnis berbasis AI.</p>
                    <a href="<?php echo e(route('register')); ?>" class="btn-primary px-10 py-4 text-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Mulai Sekarang — Gratis!
                    </a>
                </div>
            </div>
        </div>
    </section>

    
    <footer class="border-t border-white/5 py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div
                            class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <span class="text-lg font-bold gradient-text">UMKM-AI</span>
                    </div>
                    <p class="text-xs text-dark-500 leading-relaxed">Platform analisis dan digitalisasi UMKM berbasis AI
                        nomor satu di Indonesia.</p>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-white mb-4">Platform</h4>
                    <ul class="space-y-2 text-xs text-dark-500">
                        <li><a href="#features" class="hover:text-indigo-400 transition">Fitur</a></li>
                        <li><a href="#how-it-works" class="hover:text-indigo-400 transition">Cara Kerja</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Harga</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-white mb-4">Perusahaan</h4>
                    <ul class="space-y-2 text-xs text-dark-500">
                        <li><a href="#about" class="hover:text-indigo-400 transition">Tentang</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Blog</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Karir</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold text-white mb-4">Bantuan</h4>
                    <ul class="space-y-2 text-xs text-dark-500">
                        <li><a href="#" class="hover:text-indigo-400 transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Kontak</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition">Kebijakan Privasi</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-white/5 pt-8 text-center">
                <p class="text-xs text-dark-600">&copy; <?php echo e(date('Y')); ?> UMKM-AI. All rights reserved.</p>
            </div>
        </div>
    </footer>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // ===== PARTICLE BACKGROUND =====
            const particlesContainer = document.getElementById('particles');
            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.width = (Math.random() * 4 + 2) + 'px';
                particle.style.height = particle.style.width;
                particle.style.opacity = Math.random() * 0.5 + 0.1;
                particlesContainer.appendChild(particle);
            }

            anime({
                targets: '.particle',
                translateX: () => anime.random(-100, 100),
                translateY: () => anime.random(-100, 100),
                opacity: [
                    { value: () => anime.random(1, 5) / 10, duration: () => anime.random(2000, 4000) },
                    { value: () => anime.random(1, 3) / 10, duration: () => anime.random(2000, 4000) }
                ],
                scale: [
                    { value: () => anime.random(8, 15) / 10, duration: () => anime.random(2000, 4000) },
                    { value: 1, duration: () => anime.random(2000, 4000) }
                ],
                duration: () => anime.random(6000, 12000),
                loop: true,
                easing: 'easeInOutQuad',
                delay: () => anime.random(0, 2000),
            });

            // ===== GRADIENT ORBS ANIMATION =====
            anime({
                targets: '#orb-1',
                translateX: [0, 80, -40, 0],
                translateY: [0, -60, 40, 0],
                scale: [1, 1.2, 0.9, 1],
                duration: 20000,
                loop: true,
                easing: 'easeInOutSine',
            });

            anime({
                targets: '#orb-2',
                translateX: [0, -60, 80, 0],
                translateY: [0, 40, -60, 0],
                scale: [1, 0.9, 1.1, 1],
                duration: 25000,
                loop: true,
                easing: 'easeInOutSine',
            });

            anime({
                targets: '#orb-3',
                scale: [1, 1.3, 0.8, 1],
                opacity: [0.5, 0.8, 0.4, 0.5],
                duration: 15000,
                loop: true,
                easing: 'easeInOutSine',
            });

            // ===== HERO ANIMATIONS =====
            const heroTimeline = anime.timeline({ easing: 'easeOutCubic' });

            heroTimeline
                .add({
                    targets: '#hero-badge',
                    opacity: [0, 1],
                    translateY: [20, 0],
                    duration: 800,
                })
                .add({
                    targets: '.hero-word',
                    opacity: [0, 1],
                    translateY: [30, 0],
                    duration: 600,
                    delay: anime.stagger(100),
                }, '-=400')
                .add({
                    targets: '#hero-subtitle',
                    opacity: [0, 1],
                    translateY: [20, 0],
                    duration: 800,
                }, '-=200')
                .add({
                    targets: '#hero-cta',
                    opacity: [0, 1],
                    translateY: [20, 0],
                    duration: 800,
                }, '-=400')
                .add({
                    targets: '#hero-preview',
                    opacity: [0, 1],
                    translateY: [60, 0],
                    scale: [0.95, 1],
                    duration: 1200,
                }, '-=400');

            // Chart bars animation in preview
            anime({
                targets: '.chart-bar',
                height: (el) => el.style.height,
                duration: 1500,
                delay: anime.stagger(50),
                easing: 'easeOutElastic(1, .5)',
            });

            // ===== SCROLL ANIMATIONS =====
            const observerCallback = (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;

                        if (el.classList.contains('feature-card')) {
                            anime({
                                targets: el,
                                opacity: [0, 1],
                                translateY: [40, 0],
                                scale: [0.95, 1],
                                duration: 800,
                                easing: 'easeOutCubic',
                            });
                        }

                        if (el.classList.contains('feature-animate') || el.classList.contains('step-animate') || el.classList.contains('stat-section-animate')) {
                            anime({
                                targets: el,
                                opacity: [0, 1],
                                translateY: [30, 0],
                                duration: 700,
                                easing: 'easeOutCubic',
                            });
                        }

                        if (el.classList.contains('step-card')) {
                            anime({
                                targets: el,
                                opacity: [0, 1],
                                translateY: [40, 0],
                                duration: 800,
                                easing: 'easeOutCubic',
                            });
                        }

                        if (el.classList.contains('counter-item')) {
                            const counterEl = el.querySelector('[data-target]');
                            const target = parseInt(counterEl.dataset.target);
                            anime({
                                targets: el,
                                opacity: [0, 1],
                                translateY: [30, 0],
                                duration: 600,
                                easing: 'easeOutCubic',
                            });
                            const obj = { val: 0 };
                            anime({
                                targets: obj,
                                val: target,
                                duration: 2000,
                                round: 1,
                                easing: 'easeOutExpo',
                                update: () => {
                                    counterEl.textContent = obj.val.toLocaleString('id-ID') + (target < 100 && target > 1 ? '+' : '+');
                                }
                            });
                        }

                        if (el.classList.contains('about-animate')) {
                            anime({
                                targets: el,
                                opacity: [0, 1],
                                translateX: el === document.querySelectorAll('.about-animate')[0] ? [-40, 0] : [40, 0],
                                duration: 800,
                                easing: 'easeOutCubic',
                            });
                        }

                        if (el.classList.contains('cta-animate')) {
                            anime({
                                targets: el,
                                opacity: [0, 1],
                                scale: [0.9, 1],
                                duration: 800,
                                easing: 'easeOutCubic',
                            });
                        }

                        observer.unobserve(el);
                    }
                });
            };

            const observer = new IntersectionObserver(observerCallback, { threshold: 0.15 });

            document.querySelectorAll('.feature-card, .feature-animate, .step-animate, .step-card, .counter-item, .stat-section-animate, .about-animate, .cta-animate').forEach(el => {
                el.style.opacity = '0';
                observer.observe(el);
            });

            // ===== NAVBAR SCROLL EFFECT (glass transparan) =====
            const nav = document.querySelector('nav.fixed');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    nav.style.background = 'rgba(2, 6, 23, 0.45)';
                    nav.style.backdropFilter = 'blur(16px)';
                    nav.style.webkitBackdropFilter = 'blur(16px)';
                } else {
                    nav.style.background = 'transparent';
                    nav.style.backdropFilter = 'none';
                    nav.style.webkitBackdropFilter = 'none';
                }
            });

        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH F:\laragon\www\project-ai\resources\views/landing.blade.php ENDPATH**/ ?>