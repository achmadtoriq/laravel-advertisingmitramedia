<?php

namespace App\Http\Controllers;

// use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;

use App\Services\GoogleAnalyticsService;

class DashboardController extends Controller
{
    public function index(GoogleAnalyticsService $ga)
    {
        return view('admin.dashboard', [
            'realtime' => $ga->getRealtimeUsers(),
            'today' => $ga->getTodayVisitors(),
            'yesterday' => $ga->getYesterdayVisitors(),
            'chart' => $ga->getVisitorsChart(7),
        ]);
    }

    public function produk_menu()
    {
        return view('admin.produk-menu');
    }

    public function setting_menu()
    {
        return view('admin.setting-menu');
    }
}
