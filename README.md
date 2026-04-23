<p align="center">
  <img src="https://img.shields.io/badge/UMKM.AI-Platform-blueviolet?style=for-the-badge&logo=robot&logoColor=white" alt="UMKM.AI">
</p>

<h1 align="center">🤖 UMKM.AI — Smart Business Platform</h1>

<p align="center">
  <strong>Platform manajemen bisnis UMKM berbasis AI untuk analisis cerdas, pengelolaan produk, transaksi, dan pelanggan.</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/TailwindCSS-4.x-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/Vite-8.x-646CFF?style=flat-square&logo=vite&logoColor=white" alt="Vite">
  <img src="https://img.shields.io/badge/AI-OpenRouter-10B981?style=flat-square&logo=openai&logoColor=white" alt="AI">
  <img src="https://img.shields.io/badge/License-MIT-yellow?style=flat-square" alt="License">
</p>

---

## 📋 Deskripsi

**UMKM.AI** adalah platform manajemen bisnis digital yang dirancang khusus untuk pelaku UMKM (Usaha Mikro, Kecil, dan Menengah) di Indonesia. Platform ini mengintegrasikan kecerdasan buatan (AI) untuk memberikan analisis bisnis, rekomendasi produk, insight pelanggan, dan asisten chat AI — semuanya dalam Bahasa Indonesia.

## ✨ Fitur Utama

### 🏪 Manajemen Bisnis
- **Multi-tenant Architecture** — Setiap penjual memiliki lingkungan data terpisah
- **Manajemen Produk** — CRUD lengkap dengan tracking stok & harga
- **Manajemen Transaksi** — Pencatatan penjualan & riwayat transaksi
- **Manajemen Pelanggan** — Database pelanggan dengan analisis pembelian

### 🤖 AI-Powered Analytics
- **Business Insights** — Analisis SWOT otomatis, health score, dan prediksi pendapatan
- **Product Recommendations** — Rekomendasi restock, produk kurang laku, & ide produk baru
- **Customer Segmentation** — Segmentasi pelanggan otomatis (setia, potensial, perlu dipertahankan, tidak aktif)
- **AI Chat Assistant** — Tanya jawab bisnis dengan AI dalam Bahasa Indonesia

### 👥 Multi-Role System
| Role | Akses |
|------|-------|
| **Admin** | Dashboard global, manajemen seller, analytics platform, pengaturan sistem |
| **Seller** | Dashboard bisnis, produk, transaksi, pelanggan, AI analytics, profil |

### 📊 Dashboard & Analytics
- Dashboard real-time dengan statistik bisnis
- Grafik pendapatan harian (30 hari terakhir)
- Pertumbuhan revenue bulan-ke-bulan
- Activity logs & audit trail

## 🛠️ Tech Stack

| Teknologi | Versi | Fungsi |
|-----------|-------|--------|
| **Laravel** | 13.x | Backend Framework |
| **PHP** | 8.3+ | Server-side Language |
| **TailwindCSS** | 4.x | Styling Framework |
| **Vite** | 8.x | Build Tool & HMR |
| **SQLite** | - | Database (default) |
| **OpenRouter AI** | - | AI API Gateway |

## 📁 Struktur Proyek

```
project-ai/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/             # Admin controllers
│   │   ├── Seller/            # Seller controllers
│   │   └── AuthController.php # Authentication
│   ├── Models/                # Eloquent models
│   ├── Services/
│   │   └── AIAnalyticsService.php  # AI integration
│   └── Providers/
├── database/
│   └── migrations/            # Database schema
├── resources/views/
│   ├── admin/                 # Admin panel views
│   ├── seller/                # Seller panel views
│   ├── auth/                  # Login & register
│   ├── components/            # Reusable Blade components
│   ├── layouts/               # Layout templates
│   └── landing.blade.php      # Landing page
├── routes/
│   └── web.php                # Web routes
└── public/                    # Public assets
```

## 🚀 Instalasi & Setup

### Prasyarat

- PHP >= 8.3
- Composer
- Node.js >= 18
- NPM

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/gifinpratama/UMKM-AI.git
   cd UMKM-AI
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup database**
   ```bash
   touch database/database.sqlite
   php artisan migrate
   ```

5. **Konfigurasi AI (opsional)**
   
   Daftarkan akun di [OpenRouter.ai](https://openrouter.ai/) dan tambahkan API key di file `.env`:
   ```env
   OPENROUTER_API_KEY=your-api-key-here
   OPENROUTER_MODEL=openai/gpt-4o-mini
   ```

6. **Jalankan aplikasi**
   ```bash
   # Menggunakan composer script (recommended)
   composer dev
   
   # Atau manual
   php artisan serve
   npm run dev
   ```

7. **Akses aplikasi**
   
   Buka browser dan kunjungi: `http://localhost:8000`

### ⚡ Quick Setup (One Command)

```bash
composer setup
```

## 🔐 Konfigurasi Environment

Salin file `.env.example` ke `.env` dan sesuaikan variabel berikut:

| Variable | Deskripsi | Default |
|----------|-----------|---------|
| `APP_NAME` | Nama aplikasi | `UMKM.AI` |
| `DB_CONNECTION` | Driver database | `sqlite` |
| `OPENROUTER_API_KEY` | API key OpenRouter | - |
| `OPENROUTER_MODEL` | Model AI yang digunakan | `openai/gpt-4o-mini` |

## 📄 Lisensi

Project ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

## 👨‍💻 Developer

**Gifin Pratama**  
📧 gifinpratama@gmail.com  
🔗 [GitHub](https://github.com/gifinpratama)

---

<p align="center">
  <sub>Dibangun dengan ❤️ untuk UMKM Indonesia</sub>
</p>
