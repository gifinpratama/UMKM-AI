# SYSTEM_MAP.md — UMKM.AI
> Last updated: 2026-05-17 | Laravel 11 + SQLite + OpenRouter AI

---

## 1. TECH STACK

| Layer        | Teknologi                                   |
|--------------|---------------------------------------------|
| Framework    | Laravel 11 (PHP)                            |
| Database     | SQLite (`database/database.sqlite`)         |
| Frontend     | Blade + Vite (CSS/JS per resource)          |
| AI Service   | OpenRouter API → `openai/gpt-4o-mini`       |
| Auth         | Laravel built-in session auth               |
| Queue/Cache  | Database driver (SQLite)                    |

---

## 2. ARSITEKTUR LAYER

```
Browser/User
    ↓
routes/web.php              ← Entry point semua request HTTP
    ↓
Middleware (RoleMiddleware, TenantMiddleware, auth, guest)
    ↓
Http/Controllers/           ← Handler request, validasi input, return view/redirect
    ├── AuthController
    ├── Admin/
    │   ├── DashboardController
    │   ├── SellerManagementController
    │   ├── AnalyticsController
    │   └── SettingsController
    └── Seller/
        ├── DashboardController
        ├── ProductController
        ├── TransactionController
        ├── CustomerController
        ├── AnalyticsController      ← memanggil AIAnalyticsService
        └── ProfileController
    ↓
Services/
    └── AIAnalyticsService.php       ← Business logic AI: OpenRouter HTTP call
    ↓
Models/                             ← Eloquent ORM, scope tenant()
    ├── User
    ├── UmkmDatabase
    ├── Category
    ├── Product
    ├── Customer
    ├── Transaction
    ├── AnalyticsSnapshot
    └── ActivityLog
    ↓
database/database.sqlite             ← Penyimpanan utama (SQLite)
```

---

## 3. ROUTING MAP (`routes/web.php`)

### Public
| Method | URI  | Handler                    |
|--------|------|----------------------------|
| GET    | `/`  | Closure → view `landing`   |

### Auth (guest middleware)
| Method | URI         | Controller → Method         |
|--------|-------------|-----------------------------|
| GET    | `/login`    | AuthController@showLogin    |
| POST   | `/login`    | AuthController@login        |
| GET    | `/register` | AuthController@showRegister |
| POST   | `/register` | AuthController@register     |
| POST   | `/logout`   | AuthController@logout       |

### Admin (`/admin` — middleware: auth, role:admin)
| Method | URI                              | Controller → Method                      |
|--------|----------------------------------|------------------------------------------|
| GET    | /admin/dashboard                 | Admin\DashboardController@index          |
| GET    | /admin/sellers                   | Admin\SellerManagementController@index   |
| GET    | /admin/sellers/create            | Admin\SellerManagementController@create  |
| POST   | /admin/sellers                   | Admin\SellerManagementController@store   |
| GET    | /admin/sellers/{seller}          | Admin\SellerManagementController@show    |
| PATCH  | /admin/sellers/{seller}/toggle   | Admin\SellerManagementController@toggleStatus |
| DELETE | /admin/sellers/{seller}          | Admin\SellerManagementController@destroy |
| GET    | /admin/analytics                 | Admin\AnalyticsController@index          |
| GET    | /admin/settings                  | Admin\SettingsController@index           |
| PUT    | /admin/settings/profile          | Admin\SettingsController@updateProfile   |
| PUT    | /admin/settings/password         | Admin\SettingsController@updatePassword  |
| DELETE | /admin/settings/logs             | Admin\SettingsController@clearLogs       |

### Seller (`/seller` — middleware: auth, role:seller, tenant)
| Method | URI                                       | Controller → Method                        |
|--------|-------------------------------------------|--------------------------------------------|
| GET    | /seller/dashboard                         | Seller\DashboardController@index           |
| CRUD   | /seller/products                          | Seller\ProductController (resource)        |
| GET    | /seller/transactions                      | Seller\TransactionController@index         |
| GET    | /seller/transactions/create               | Seller\TransactionController@create        |
| POST   | /seller/transactions                      | Seller\TransactionController@store         |
| GET    | /seller/transactions/{id}                 | Seller\TransactionController@show          |
| GET    | /seller/customers                         | Seller\CustomerController@index            |
| POST   | /seller/customers                         | Seller\CustomerController@store            |
| PUT    | /seller/customers/{customer}              | Seller\CustomerController@update           |
| DELETE | /seller/customers/{customer}              | Seller\CustomerController@destroy          |
| GET    | /seller/analytics                         | Seller\AnalyticsController@index           |
| POST   | /seller/analytics/generate                | Seller\AnalyticsController@generate        |
| GET    | /seller/analytics/product-recommendations | Seller\AnalyticsController@productRecommendations |
| GET    | /seller/analytics/customer-insights       | Seller\AnalyticsController@customerInsights|
| POST   | /seller/analytics/chat                    | Seller\AnalyticsController@chat            |
| GET    | /seller/profile                           | Seller\ProfileController@index             |
| PUT    | /seller/profile                           | Seller\ProfileController@update            |
| PUT    | /seller/profile/password                  | Seller\ProfileController@updatePassword    |

---

## 4. MODELS & DATABASE SCHEMA

### Multi-Tenancy
- Kolom `tenant_id` (UUID) ada di: `products`, `customers`, `transactions`, `analytics_snapshots`, `activity_logs`
- Semua Model seller punya scope `tenant()` → filter by `tenant_id`
- `UmkmDatabase` menyimpan profil bisnis per tenant

### Tabel Utama
| Tabel                | Model               | Kunci Relasi           |
|----------------------|---------------------|------------------------|
| users                | User                | id, role, is_active    |
| umkm_databases       | UmkmDatabase        | user_id (FK → users)   |
| categories           | Category            | tenant_id              |
| products             | Product             | tenant_id, category_id |
| customers            | Customer            | tenant_id              |
| transactions         | Transaction         | tenant_id, customer_id |
| analytics_snapshots  | AnalyticsSnapshot   | tenant_id              |
| activity_logs        | ActivityLog         | tenant_id, user_id     |
| cache                | (Laravel cache)     | —                      |
| jobs                 | (Laravel queue)     | —                      |
| sessions             | (Laravel session)   | —                      |

---

## 5. SERVICES

### `AIAnalyticsService` (`app/Services/AIAnalyticsService.php`)
**Caller:** `Seller\AnalyticsController`
**Dependensi:** OpenRouter API (HTTPS), Models: Product, Transaction, Customer, AnalyticsSnapshot

| Method                      | Fungsi                                                  | Side Effect          |
|-----------------------------|---------------------------------------------------------|----------------------|
| `askAI()`                   | HTTP POST ke OpenRouter, return string response         | HTTP call eksternal  |
| `generateBusinessInsights()`| Kumpul data bisnis + AI → simpan AnalyticsSnapshot      | DB write             |
| `getProductRecommendations()`| AI insight produk & stok                              | HTTP call eksternal  |
| `getCustomerInsights()`     | AI segmentasi pelanggan                                 | HTTP call eksternal  |
| `chat()`                    | AI chatbot berbasis data bisnis tenant                  | HTTP call eksternal  |
| `collectBusinessData()`     | Agregasi data KPI dari DB (revenue, produk, transaksi)  | DB read heavy        |
| `getQuickStats()`           | Alias `collectBusinessData()` untuk dashboard           | DB read              |

---

## 6. MIDDLEWARE

| Middleware         | Alias   | Fungsi                                                         |
|--------------------|---------|----------------------------------------------------------------|
| `RoleMiddleware`   | `role`  | Cek `user->role === $role`, redirect jika tidak sesuai        |
| `TenantMiddleware` | `tenant`| Set tenant context ke request/session (isolasi data UMKM)     |
| `auth`             | bawaan  | Cek autentikasi sesi                                           |
| `guest`            | bawaan  | Redirect jika sudah login                                      |

---

## 7. VIEWS STRUCTURE

```
resources/views/
├── landing.blade.php            ← Landing page publik
├── welcome.blade.php            ← (fallback/unused)
├── layouts/
│   └── ...                      ← Layout utama (app shell)
├── components/
│   └── ...                      ← Reusable Blade components
├── auth/
│   └── ...                      ← Login & register pages
├── admin/
│   ├── dashboard.blade.php
│   ├── analytics.blade.php
│   ├── settings.blade.php
│   └── sellers/
├── seller/
│   ├── dashboard.blade.php
│   ├── analytics.blade.php
│   ├── profile.blade.php
│   ├── products/
│   ├── transactions/
│   └── customers/
```

---

## 8. KONFIGURASI KUNCI

| Config                     | Nilai                              |
|----------------------------|------------------------------------|
| `DB_CONNECTION`            | sqlite                             |
| `SESSION_DRIVER`           | database                           |
| `QUEUE_CONNECTION`         | database                           |
| `CACHE_STORE`              | database                           |
| `OPENROUTER_API_KEY`       | `sk-or-v1-...` (di `.env`)        |
| `OPENROUTER_MODEL`         | `openai/gpt-4o-mini`               |
| `APP_URL`                  | `http://localhost`                 |

---

## 9. ENTRY POINT DEVELOPMENT

```bash
# Jalankan dev server
php artisan serve

# Jalankan Vite (frontend assets)
npm run dev

# Migrate & seed
php artisan migrate --seed
```

---

## 10. CATATAN ARSITEKTUR

- **Multi-tenancy sederhana** via `tenant_id` kolom (bukan DB terpisah).
- **Tidak ada Repository layer** — Controller langsung ke Model.
- **AI hanya di Seller analytics** — Admin analytics adalah agregat platform.
- `collectBusinessData()` bersifat read-heavy: 7+ query per panggilan. Kandidat untuk caching jika data tumbuh besar.
- `Transaction->items` disimpan sebagai JSON array (bukan tabel terpisah) — perlu diperhatikan saat query produk terlaris.
