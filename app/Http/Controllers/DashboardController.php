<?php

namespace App\Http\Controllers;

use App\Services\GoogleAnalyticsService;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(GoogleAnalyticsService $ga)
    {
        $chart = collect($ga->getVisitorsChart(7))->sortBy('date')->values();
        $realtime = (int) $ga->getRealtimeUsers();
        $today = (int) $ga->getTodayVisitors();
        $yesterday = (int) $ga->getYesterdayVisitors();
        $topContent = $ga->getTopContent();
        $searchQueries = $ga->getSearchQueries();

        $labels = collect($chart)->map(function ($item) {
            return Carbon::createFromFormat('Ymd', $item['date'])->format('d M');
        });

        $data = collect($chart)->pluck('users');
        $last7Days = (int) collect($chart)->sum('users');

        return view('admin.dashboard', [
            'gaEnabled' => $ga->isEnabled(),
            'gaMessages' => $ga->statusMessages(),
            'searchConsoleMessages' => $ga->searchConsoleStatusMessages(),
            'searchQueries' => $searchQueries,
            'topContent' => $topContent,
            'realtime' => $realtime,
            'today' => $today,
            'yesterday' => $yesterday,
            'last7Days' => $last7Days,
            'dailyChange' => $today - $yesterday,
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
