<?php

namespace App\Services;

use Google\Analytics\Data\V1beta\Client\BetaAnalyticsDataClient;
use Google\Analytics\Data\V1beta\DateRange;
use Google\Analytics\Data\V1beta\Metric;
use Google\Analytics\Data\V1beta\RunRealtimeReportRequest;
use Google\Analytics\Data\V1beta\RunReportRequest;
use Illuminate\Support\Facades\Cache;

class GoogleAnalyticsService
{
    public function getRealtimeUsers()
    {
        return Cache::remember('ga_realtime', 60, function () {

            $client = new BetaAnalyticsDataClient([
                'credentials' => base_path(env('GA_CREDENTIALS'))
            ]);

            $request = new RunRealtimeReportRequest([
                'property' => 'properties/' . env('GA_PROPERTY_ID'),
                'metrics' => [
                    new Metric([
                        'name' => 'activeUsers'
                    ])
                ]
            ]);

            $response = $client->runRealtimeReport($request);

            $rows = $response->getRows();

            if ($rows && count($rows) > 0) {

                $metrics = $rows[0]->getMetricValues();

                if ($metrics && count($metrics) > 0) {
                    return (int) $metrics[0]->getValue();
                }
            }

            return 0;
        });
    }

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

    public function getVisitorsChart($days = 7)
    {
        return Cache::remember('ga_chart_' . $days, 600, function () use ($days) {

            $client = new BetaAnalyticsDataClient([
                'credentials' => base_path(env('GA_CREDENTIALS'))
            ]);

            $request = new RunReportRequest([
                'property' => 'properties/' . env('GA_PROPERTY_ID'),
                'date_ranges' => [
                    new DateRange([
                        'start_date' => $days . 'daysAgo',
                        'end_date' => 'today',
                    ])
                ],
                'metrics' => [
                    new Metric([
                        'name' => 'activeUsers'
                    ])
                ],
                'dimensions' => [
                    new \Google\Analytics\Data\V1beta\Dimension([
                        'name' => 'date'
                    ])
                ]
            ]);

            $response = $client->runReport($request);

            $data = [];

            foreach ($response->getRows() as $row) {
                $data[] = [
                    'date' => $row->getDimensionValues()[0]->getValue(),
                    'users' => (int) $row->getMetricValues()[0]->getValue(),
                ];
            }

            return $data;
        });
    }
}
