<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\AnalyticsSnapshot;

class AIAnalyticsService
{
    protected string $apiKey;
    protected string $model;
    protected string $baseUrl = 'https://openrouter.ai/api/v1/chat/completions';

    public function __construct()
    {
        $this->apiKey = config('services.openrouter.api_key', env('OPENROUTER_API_KEY', ''));
        $this->model = config('services.openrouter.model', env('OPENROUTER_MODEL', 'openai/gpt-4o-mini'));
    }

    /**
     * Send a prompt to OpenRouter AI and get response
     */
    protected function askAI(string $systemPrompt, string $userPrompt): ?string
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
                'HTTP-Referer' => config('app.url', 'http://localhost'),
                'X-Title' => 'UMKM-AI Analytics',
            ])->timeout(30)->post($this->baseUrl, [
                'model' => $this->model,
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $userPrompt],
                ],
                'temperature' => 0.7,
                'max_tokens' => 2000,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['choices'][0]['message']['content'] ?? null;
            }

            return null;
        } catch (\Exception $e) {
            \Log::error('OpenRouter AI Error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Generate comprehensive business analytics with AI
     */
    public function generateBusinessInsights(string $tenantId): array
    {
        $data = $this->collectBusinessData($tenantId);
        
        $systemPrompt = "Kamu adalah AI analis bisnis UMKM profesional. Berikan analisis dalam Bahasa Indonesia yang mudah dipahami oleh pemilik UMKM. Format jawaban dalam JSON dengan keys: summary, strengths (array), weaknesses (array), opportunities (array), recommendations (array), health_score (0-100), trend (naik/turun/stabil), predicted_revenue_next_month (number).";
        
        $userPrompt = "Analisis data bisnis UMKM berikut:\n\n" . json_encode($data, JSON_PRETTY_PRINT);

        $aiResponse = $this->askAI($systemPrompt, $userPrompt);
        
        $insights = [];
        if ($aiResponse) {
            // Try to parse JSON from response
            $cleaned = preg_replace('/```json\s*|\s*```/', '', $aiResponse);
            $insights = json_decode($cleaned, true) ?? ['raw_response' => $aiResponse];
        }

        // Save snapshot
        AnalyticsSnapshot::create([
            'tenant_id' => $tenantId,
            'type' => 'daily',
            'data' => $data,
            'insights' => $insights,
            'ai_response' => ['raw' => $aiResponse],
            'generated_at' => now(),
        ]);

        return [
            'data' => $data,
            'insights' => $insights,
            'generated_at' => now()->toDateTimeString(),
        ];
    }

    /**
     * Get AI product recommendations
     */
    public function getProductRecommendations(string $tenantId): ?string
    {
        $products = Product::tenant($tenantId)->get(['name', 'price', 'cost_price', 'stock', 'is_active'])->toArray();
        $transactions = Transaction::tenant($tenantId)
            ->where('status', 'completed')
            ->latest()
            ->take(50)
            ->get(['items', 'total', 'created_at'])
            ->toArray();

        $systemPrompt = "Kamu adalah AI advisor produk UMKM. Berikan rekomendasi dalam Bahasa Indonesia tentang: produk mana yang harus di-restock, produk yang kurang laku dan perlu strategi baru, ide produk baru berdasarkan tren. Format singkat dan actionable.";
        
        $userPrompt = "Data produk:\n" . json_encode($products) . "\n\nData transaksi terbaru:\n" . json_encode($transactions);

        return $this->askAI($systemPrompt, $userPrompt);
    }

    /**
     * Get AI customer insights
     */
    public function getCustomerInsights(string $tenantId): ?string
    {
        $customers = Customer::tenant($tenantId)->get(['name', 'total_purchases', 'total_transactions', 'last_purchase_at'])->toArray();
        
        $systemPrompt = "Kamu adalah AI analis pelanggan UMKM. Segmentasi pelanggan menjadi: Pelanggan Setia, Pelanggan Potensial, Pelanggan yang Perlu Dipertahankan, Pelanggan Tidak Aktif. Berikan strategi untuk setiap segmen dalam Bahasa Indonesia.";
        
        $userPrompt = "Data pelanggan:\n" . json_encode($customers);

        return $this->askAI($systemPrompt, $userPrompt);
    }

    /**
     * Chat with AI about business
     */
    public function chat(string $tenantId, string $message): ?string
    {
        $data = $this->collectBusinessData($tenantId);
        
        $systemPrompt = "Kamu adalah AI asisten bisnis UMKM bernama 'UMKM-AI Assistant'. Jawab pertanyaan pemilik UMKM berdasarkan data bisnis mereka. Gunakan Bahasa Indonesia yang ramah dan mudah dipahami. Data bisnis saat ini:\n" . json_encode($data);

        return $this->askAI($systemPrompt, $message);
    }

    /**
     * Collect all business data for a tenant
     */
    protected function collectBusinessData(string $tenantId): array
    {
        $totalProducts = Product::tenant($tenantId)->count();
        $activeProducts = Product::tenant($tenantId)->where('is_active', true)->count();
        $lowStock = Product::tenant($tenantId)->where('stock', '<', 10)->count();
        
        $totalCustomers = Customer::tenant($tenantId)->count();
        
        $thisMonth = Transaction::tenant($tenantId)
            ->where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year);
        
        $lastMonth = Transaction::tenant($tenantId)
            ->where('status', 'completed')
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', now()->subMonth()->year);

        $revenueThisMonth = (clone $thisMonth)->sum('total');
        $revenueLastMonth = (clone $lastMonth)->sum('total');
        $transactionsThisMonth = (clone $thisMonth)->count();
        $transactionsLastMonth = (clone $lastMonth)->count();

        $topProducts = Transaction::tenant($tenantId)
            ->where('status', 'completed')
            ->whereMonth('created_at', now()->month)
            ->get()
            ->pluck('items')
            ->flatten(1)
            ->groupBy('name')
            ->map(fn($items) => $items->sum('quantity'))
            ->sortDesc()
            ->take(5)
            ->toArray();

        $revenueGrowth = $revenueLastMonth > 0 
            ? round((($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100, 2) 
            : 0;

        // Daily revenue for the last 30 days
        $dailyRevenue = Transaction::tenant($tenantId)
            ->where('status', 'completed')
            ->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, SUM(total) as revenue, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->toArray();

        return [
            'total_products' => $totalProducts,
            'active_products' => $activeProducts,
            'low_stock_products' => $lowStock,
            'total_customers' => $totalCustomers,
            'revenue_this_month' => $revenueThisMonth,
            'revenue_last_month' => $revenueLastMonth,
            'revenue_growth_percent' => $revenueGrowth,
            'transactions_this_month' => $transactionsThisMonth,
            'transactions_last_month' => $transactionsLastMonth,
            'top_products' => $topProducts,
            'daily_revenue_30d' => $dailyRevenue,
            'avg_transaction_value' => $transactionsThisMonth > 0 ? round($revenueThisMonth / $transactionsThisMonth, 2) : 0,
        ];
    }

    /**
     * Get basic stats without AI (for dashboard quick view)
     */
    public function getQuickStats(string $tenantId): array
    {
        return $this->collectBusinessData($tenantId);
    }
}
