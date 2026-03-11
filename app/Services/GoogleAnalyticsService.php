<?php

namespace App\Services;

use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Illuminate\Support\Facades\Cache;

class GoogleAnalyticsService
{
    public function getTodayVisitors()
    {
        return Cache::remember('ga_today', 600, function () {
            return $this->fetchVisitors('today', 'today');
        });
    }

    public function getYesterdayVisitors()
    {
        return Cache::remember('ga_yesterday', 600, function () {
            return $this->fetchVisitors('yesterday', 'yesterday');
        });
    }

    public function getLast7DaysVisitors()
    {
        return Cache::remember('ga_7days', 600, function () {
            return $this->fetchVisitors('7daysAgo', 'today');
        });
    }

    private function fetchVisitors($start, $end)
    {
        $client = new BetaAnalyticsDataClient([
            'credentials' => base_path(env('GA_CREDENTIALS'))
        ]);

        $request = new RunReportRequest([
            'property' => 'properties/' . env('GA_PROPERTY_ID'),
            'date_ranges' => [
                new DateRange([
                    'start_date' => $start,
                    'end_date' => $end,
                ])
            ],
            'metrics' => [
                new Metric([
                    // 'name' => 'activeUsers'
                    'name' => 'totalUsers'
                ])
            ]
        ]);

        $response = $client->runReport($request);

        $rows = $response->getRows();

        if ($rows && count($rows) > 0) {

            $metrics = $rows[0]->getMetricValues();

            if ($metrics && count($metrics) > 0) {
                return $metrics[0]->getValue();
            }
        }

        return 0;
    }
}
