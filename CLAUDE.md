# CLAUDE.md — UMKM-AI Project Instructions

## Project Overview

UMKM-AI adalah platform SaaS multi-tenant untuk digitalisasi UMKM Indonesia. Fitur utama meliputi manajemen produk, transaksi, pelanggan, dan analisis bisnis berbasis AI. Status saat ini: **Beta Testing**.

## Tech Stack

- **Framework:** Laravel 11 (PHP 8.3)
- **Database:** SQLite (development), MySQL (production-ready)
- **Frontend:** Blade templates + Tailwind CSS v4 + Vite
- **AI Service:** Gemini API via `App\Services\AIAnalyticsService`
- **Server:** Laragon (Windows, `F:\laragon\www\project-ai`)
- **PHP Path:** `F:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe`

## Architecture

### Multi-Tenant System
- Every seller has a unique `tenant_id` (format: `tenant_XXXXXXXXXXXX`)
- All data models (Product, Transaction, Customer, Category) are scoped by `tenant_id`
- Use `->scopeTenant($tenantId)` on models, NOT raw where clauses
- Tenant middleware enforces isolation at route level

### Role-Based Access
| Role | Prefix | Middleware | Dashboard Route |
|------|--------|-----------|-----------------|
| Admin | `/admin` | `auth, role:admin` | `admin.dashboard` |
| Seller | `/seller` | `auth, role:seller, tenant` | `seller.dashboard` |

### Models
```
User (role: admin|seller, tenant_id)
├── Product (tenant_id, category_id)
├── Transaction (tenant_id, items JSON)
├── Customer (tenant_id)
├── Category (tenant_id)
├── ActivityLog (user_id)
├── AnalyticsSnapshot (tenant_id)
└── UmkmDatabase (tenant_id, user_id)
```

### Controllers
```
App\Http\Controllers\
├── AuthController              # Login, Register, Logout
├── Admin\
│   ├── DashboardController     # Admin overview (cached)
│   ├── SellerManagementController  # CRUD sellers
│   ├── AnalyticsController     # Global analytics
│   └── SettingsController      # Admin profile & settings
└── Seller\
    ├── DashboardController     # Seller overview (cached per tenant)
    ├── ProductController       # CRUD products
    ├── TransactionController   # Record & view transactions
    ├── CustomerController      # CRUD customers
    ├── AnalyticsController     # AI-powered analytics
    └── ProfileController       # Business profile
```

### Observers (Cache Busting)
```
App\Observers\
├── TransactionObserver   # Clears seller + admin dashboard caches
└── ProductObserver       # Clears seller + admin dashboard caches
```

## Design System — Neubrutalism

**IMPORTANT:** The project uses a **Neubrutalism** design system. See `DESIGN.md` for full specification.

### Key Rules
1. **NEVER use `glass-card` class** — always use `card-elevated` instead
2. **Fonts:** Space Grotesk (display/headings), Space Mono (body/mono)
3. **Borders:** Thick black borders (`3px solid #000`) with hard offset shadows
4. **Shadows:** Hard offset, NOT blurred (`5px 5px 0 0 #000000`)
5. **Colors:** Orange (`#DD6B20`), Teal (`#8BD3DD`), Golden (`#FAAE2B`)
6. **No glassmorphism** — no `backdrop-blur`, no `bg-white/10` transparency patterns

### CSS Class Reference
| Class | Usage |
|-------|-------|
| `card-elevated` | All card containers (forms, tables, content blocks) |
| `btn-primary` | Orange CTA buttons |
| `btn-secondary` | Teal/outlined buttons |
| `btn-danger` | Red destructive actions |
| `btn-accent` | Golden accent buttons |
| `form-input` | All input fields |
| `form-label` | Input labels |
| `data-table` | All data tables |
| `badge` | Status indicators (+ `badge-success`, `badge-warning`, `badge-danger`, `badge-info`) |
| `sidebar-link` | Sidebar navigation items |

### CSS Variables (defined in `resources/css/app.css`)
```css
--color-orange: #DD6B20;
--color-teal: #8BD3DD;
--color-golden: #FAAE2B;
--color-pink: #FE98A3;
--nb-border: 3px solid #000000;
--nb-shadow: 5px 5px 0 0 #000000;
--nb-shadow-sm: 3px 3px 0 0 #000000;
--nb-shadow-lg: 8px 8px 0 0 #000000;
```

## Coding Conventions

### Blade Views
- Layout: `layouts/app.blade.php` (authenticated), `layouts/landing.blade.php` (public)
- Sidebar: `components/sidebar.blade.php`
- Use inline `style=""` for component-specific styling, NOT Tailwind utility classes for complex styles
- Animation: Use `anime.js` with `card-elevated` selector for page-load animations
- Images: Always add `loading="lazy"` and `alt` attributes

### Controllers
- Use `Cache::remember()` for dashboard stats (TTL: 300s for stats, 600s for charts)
- Tenant-scoped cache keys: `"seller_{metric}_{$tenantId}"`
- Admin cache keys: `"admin_{metric}"`
- Pagination: Always use `->paginate(10)` and `->withQueryString()` in views
- Eager load relationships: `->with('relation')` to avoid N+1

### Sidebar Active States
- Use specific route names, NOT wildcards for parent items
- Example: `request()->routeIs('admin.sellers.index', 'admin.sellers.show')` — NOT `admin.sellers.*`
- Child items use their specific route: `request()->routeIs('admin.sellers.create')`

### Branding
- App name: **UMKM-AI** (with hyphen, NOT "UMKM.AI")
- Tagline: "Analisis Cerdas"
- Status: Beta Testing — display beta notice on landing page
- Copyright: `© {year} UMKM-AI`

## Commands

```bash
# Dev server
npm run dev

# Production build
npm run build

# Clear caches (use full PHP path on this machine)
F:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe artisan view:clear
F:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe artisan cache:clear

# Or if PHP is in PATH via Laragon terminal:
php artisan view:clear
php artisan cache:clear
php artisan migrate
```

## File Structure (Key Files)

```
project-ai/
├── CLAUDE.md              ← You are here
├── DESIGN.md              ← Full design system specification
├── app/
│   ├── Http/Controllers/  ← Business logic
│   ├── Models/            ← Eloquent models with tenant scopes
│   ├── Observers/         ← Cache busting on data changes
│   ├── Services/          ← AIAnalyticsService (Gemini API)
│   └── Providers/         ← Observer registration
├── resources/
│   ├── css/app.css        ← Neubrutalism design tokens + components
│   └── views/
│       ├── layouts/       ← app.blade.php, landing.blade.php
│       ├── components/    ← sidebar.blade.php
│       ├── admin/         ← Admin panel views
│       ├── seller/        ← Seller panel views
│       ├── auth/          ← Login & Register
│       └── landing.blade.php  ← Public landing page
├── routes/web.php         ← All route definitions
└── database/
    └── database.sqlite    ← Development database
```

## Common Pitfalls

1. **PowerShell `php` not found** — Use full path `F:\laragon\bin\php\php-8.3.30-Win32-vs16-x64\php.exe` or run from Laragon Terminal
2. **View caching** — After editing Blade files, run `php artisan view:clear` if changes don't show
3. **Z-index conflicts** — Landing page has fixed beta banner (z-200) + fixed nav (z-50). Check stacking context if elements become unclickable
4. **Tailwind v4 syntax** — Uses `@import 'tailwindcss'` and `@theme {}` blocks, NOT v3 `@tailwind` directives
5. **SQLite date functions** — Use `strftime('%Y-%m', created_at)` instead of MySQL `DATE_FORMAT()`
