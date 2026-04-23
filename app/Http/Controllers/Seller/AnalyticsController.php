<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Services\AIAnalyticsService;
use App\Models\AnalyticsSnapshot;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index(AIAnalyticsService $ai)
    {
        $tenantId = auth()->user()->tenant_id;
        $stats = $ai->getQuickStats($tenantId);
        
        // Get latest AI snapshot
        $latestSnapshot = AnalyticsSnapshot::tenant($tenantId)
            ->latest('generated_at')
            ->first();

        return view('seller.analytics', compact('stats', 'latestSnapshot'));
    }

    public function generate(AIAnalyticsService $ai)
    {
        $tenantId = auth()->user()->tenant_id;
        $result = $ai->generateBusinessInsights($tenantId);

        return redirect()->route('seller.analytics')
            ->with('success', 'Analisis AI berhasil di-generate!')
            ->with('ai_result', $result);
    }

    public function productRecommendations(AIAnalyticsService $ai)
    {
        $tenantId = auth()->user()->tenant_id;
        $recommendations = $ai->getProductRecommendations($tenantId);

        return response()->json([
            'success' => true,
            'recommendations' => $recommendations,
        ]);
    }

    public function customerInsights(AIAnalyticsService $ai)
    {
        $tenantId = auth()->user()->tenant_id;
        $insights = $ai->getCustomerInsights($tenantId);

        return response()->json([
            'success' => true,
            'insights' => $insights,
        ]);
    }

    public function chat(Request $request, AIAnalyticsService $ai)
    {
        $request->validate(['message' => 'required|string|max:1000']);
        
        $tenantId = auth()->user()->tenant_id;
        $response = $ai->chat($tenantId, $request->message);

        return response()->json([
            'success' => true,
            'response' => $response ?? 'Maaf, saya tidak bisa memproses permintaan Anda saat ini.',
        ]);
    }
}
