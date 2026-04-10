<?php

namespace App\Http\Controllers;

// use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;

use App\Services\GoogleAnalyticsService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(GoogleAnalyticsService $ga)
    {
        $chart = collect($ga->getVisitorsChart(7))->sortBy('date')->values();

        $labels = collect($chart)->map(function ($item) {
            return Carbon::createFromFormat('Ymd', $item['date'])->format('d M');
        });

        $data = collect($chart)->pluck('users');

        return view('admin.dashboard', [
            'realtime' => $ga->getRealtimeUsers(),
            'today' => $ga->getTodayVisitors(),
            'yesterday' => $ga->getYesterdayVisitors(),
            'labels' => $labels,
            'data' => $data,
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
