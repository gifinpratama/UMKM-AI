<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SellerManagementController;
use App\Http\Controllers\Admin\AnalyticsController as AdminAnalyticsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Seller\DashboardController as SellerDashboardController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\TransactionController;
use App\Http\Controllers\Seller\CustomerController;
use App\Http\Controllers\Seller\AnalyticsController as SellerAnalyticsController;
use App\Http\Controllers\Seller\ProfileController;

// Landing Page
Route::get('/', function () {
    return view('landing');
})->name('landing');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/sellers', [SellerManagementController::class, 'index'])->name('sellers.index');
    Route::get('/sellers/create', [SellerManagementController::class, 'create'])->name('sellers.create');
    Route::post('/sellers', [SellerManagementController::class, 'store'])->name('sellers.store');
    Route::get('/sellers/{seller}', [SellerManagementController::class, 'show'])->name('sellers.show');
    Route::patch('/sellers/{seller}/toggle-status', [SellerManagementController::class, 'toggleStatus'])->name('sellers.toggleStatus');
    Route::delete('/sellers/{seller}', [SellerManagementController::class, 'destroy'])->name('sellers.destroy');

    // Admin Analytics
    Route::get('/analytics', [AdminAnalyticsController::class, 'index'])->name('analytics');

    // Admin Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password');
    Route::delete('/settings/logs', [SettingsController::class, 'clearLogs'])->name('settings.clearLogs');
});

// Seller Routes
Route::prefix('seller')->middleware(['auth', 'role:seller', 'tenant'])->name('seller.')->group(function () {
    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');
    
    // Products
    Route::resource('products', ProductController::class)->except(['show']);
    
    // Transactions
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    
    // Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    
    // AI Analytics
    Route::get('/analytics', [SellerAnalyticsController::class, 'index'])->name('analytics');
    Route::post('/analytics/generate', [SellerAnalyticsController::class, 'generate'])->name('analytics.generate');
    Route::get('/analytics/product-recommendations', [SellerAnalyticsController::class, 'productRecommendations'])->name('analytics.productRecommendations');
    Route::get('/analytics/customer-insights', [SellerAnalyticsController::class, 'customerInsights'])->name('analytics.customerInsights');
    Route::post('/analytics/chat', [SellerAnalyticsController::class, 'chat'])->name('analytics.chat');

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
});
