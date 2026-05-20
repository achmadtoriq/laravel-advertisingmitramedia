<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Throwable;

class GoogleAnalyticsService
{
    private array $messages = [];
    private array $searchConsoleMessages = [];

    public function getRealtimeUsers()
    {
        return Cache::remember('ga_realtime', 60, function () {
            if (! $this->canConnect()) {
                return 0;
            }

            $response = $this->runRealtimeReport([
                'metrics' => [
                    ['name' => 'activeUsers'],
                ],
            ]);

            return (int) data_get($response, 'rows.0.metricValues.0.value', 0);
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
        if (! $this->canConnect()) {
            return 0;
        }

        $response = $this->runReport([
            'dateRanges' => [
                [
                    'startDate' => $start,
                    'endDate' => $end,
                ],
            ],
            'metrics' => [
                ['name' => 'totalUsers'],
            ],
        ]);

        return (int) data_get($response, 'rows.0.metricValues.0.value', 0);
    }

    public function getVisitorsChart($days = 7)
    {
        return Cache::remember('ga_chart_' . $days, 600, function () use ($days) {
            if (! $this->canConnect()) {
                return [];
            }

            $response = $this->runReport([
                'dateRanges' => [
                    [
                        'startDate' => $days . 'daysAgo',
                        'endDate' => 'today',
                    ],
                ],
                'metrics' => [
                    ['name' => 'activeUsers'],
                ],
                'dimensions' => [
                    ['name' => 'date'],
                ],
            ]);

            if (! $response) {
                return [];
            }

            return collect($response['rows'] ?? [])
                ->map(fn ($row) => [
                    'date' => data_get($row, 'dimensionValues.0.value'),
                    'users' => (int) data_get($row, 'metricValues.0.value', 0),
                ])
                ->filter(fn ($row) => filled($row['date']))
                ->values()
                ->all();
        });
    }

    public function getTopContent(int $days = 28, int $limit = 10): array
    {
        return Cache::remember("ga_top_content_{$days}_{$limit}", 1800, function () use ($days, $limit) {
            if (! $this->canConnect()) {
                return [];
            }

            $response = $this->runReport([
                'dateRanges' => [
                    [
                        'startDate' => $days . 'daysAgo',
                        'endDate' => 'today',
                    ],
                ],
                'dimensions' => [
                    ['name' => 'pagePathPlusQueryString'],
                    ['name' => 'pageTitle'],
                ],
                'metrics' => [
                    ['name' => 'screenPageViews'],
                    ['name' => 'activeUsers'],
                    ['name' => 'averageSessionDuration'],
                ],
                'orderBys' => [
                    [
                        'metric' => [
                            'metricName' => 'screenPageViews',
                        ],
                        'desc' => true,
                    ],
                ],
                'limit' => $limit,
            ]);

            if (! $response) {
                return [];
            }

            return collect($response['rows'] ?? [])
                ->map(fn ($row) => [
                    'path' => data_get($row, 'dimensionValues.0.value', '-'),
                    'title' => data_get($row, 'dimensionValues.1.value', '-'),
                    'views' => (int) data_get($row, 'metricValues.0.value', 0),
                    'users' => (int) data_get($row, 'metricValues.1.value', 0),
                    'avg_duration' => (float) data_get($row, 'metricValues.2.value', 0),
                ])
                ->values()
                ->all();
        });
    }

    public function getSearchQueries(int $days = 480, int $limit = 10): array
    {
        if (! $this->canConnectToSearchConsole()) {
            return [];
        }

        return Cache::remember("gsc_queries_{$days}_{$limit}", 3600, function () use ($days, $limit) {
            $endDate = now()->subDays(2);
            $startDate = $endDate->copy()->subDays($days - 1);
            $siteUrl = rawurlencode(env('GSC_SITE_URL'));

            try {
                $token = $this->accessToken('https://www.googleapis.com/auth/webmasters.readonly', 'search-console');

                if (! $token) {
                    return [];
                }

                $response = Http::withToken($token)
                    ->acceptJson()
                    ->timeout(10)
                    ->post("https://searchconsole.googleapis.com/webmasters/v3/sites/{$siteUrl}/searchAnalytics/query", [
                        'startDate' => $startDate->toDateString(),
                        'endDate' => $endDate->toDateString(),
                        'dimensions' => ['query'],
                        'rowLimit' => $limit,
                        'startRow' => 0,
                    ]);

                if ($response->failed()) {
                    $message = data_get($response->json(), 'error.message', $response->body());
                    $this->searchConsoleMessages[] = 'Google Search Console API gagal: ' . str($message)->limit(180);

                    return [];
                }

                return collect($response->json('rows', []))
                    ->map(fn ($row) => [
                        'query' => data_get($row, 'keys.0', '-'),
                        'clicks' => (int) data_get($row, 'clicks', 0),
                        'impressions' => (int) data_get($row, 'impressions', 0),
                        'ctr' => (float) data_get($row, 'ctr', 0),
                        'position' => (float) data_get($row, 'position', 0),
                    ])
                    ->values()
                    ->all();
            } catch (Throwable $e) {
                $this->searchConsoleMessages[] = 'Google Search Console API gagal: ' . $e->getMessage();

                return [];
            }
        });
    }

    public function getSearchLandingPages(int $days = 480, int $limit = 10): array
    {
        if (! $this->canConnectToSearchConsole()) {
            return [];
        }

        return Cache::remember("gsc_landing_pages_{$days}_{$limit}", 3600, function () use ($days, $limit) {
            $endDate = now()->subDays(2);
            $startDate = $endDate->copy()->subDays($days - 1);
            $siteUrl = rawurlencode(env('GSC_SITE_URL'));

            try {
                $token = $this->accessToken('https://www.googleapis.com/auth/webmasters.readonly', 'search-console');

                if (! $token) {
                    return [];
                }

                $response = Http::withToken($token)
                    ->acceptJson()
                    ->timeout(10)
                    ->post("https://searchconsole.googleapis.com/webmasters/v3/sites/{$siteUrl}/searchAnalytics/query", [
                        'startDate' => $startDate->toDateString(),
                        'endDate' => $endDate->toDateString(),
                        'dimensions' => ['page'],
                        'rowLimit' => $limit,
                        'startRow' => 0,
                    ]);

                if ($response->failed()) {
                    $message = data_get($response->json(), 'error.message', $response->body());
                    $this->searchConsoleMessages[] = 'Google Search Console API gagal: ' . str($message)->limit(180);

                    return [];
                }

                return collect($response->json('rows', []))
                    ->map(fn ($row) => [
                        'page' => data_get($row, 'keys.0', '-'),
                        'clicks' => (int) data_get($row, 'clicks', 0),
                        'impressions' => (int) data_get($row, 'impressions', 0),
                        'ctr' => (float) data_get($row, 'ctr', 0),
                        'position' => (float) data_get($row, 'position', 0),
                    ])
                    ->values()
                    ->all();
            } catch (Throwable $e) {
                $this->searchConsoleMessages[] = 'Google Search Console API gagal: ' . $e->getMessage();

                return [];
            }
        });
    }

    public function isEnabled(): bool
    {
        return $this->canConnect();
    }

    public function statusMessages(): array
    {
        $this->canConnect();

        return array_values(array_unique($this->messages));
    }

    public function searchConsoleStatusMessages(): array
    {
        $this->canConnectToSearchConsole();

        return array_values(array_unique($this->searchConsoleMessages));
    }

    private function canConnect(): bool
    {
        $credentials = env('GA_CREDENTIALS');
        $propertyId = env('GA_PROPERTY_ID');

        if (blank($propertyId)) {
            $this->messages[] = 'GA_PROPERTY_ID belum diisi.';
        }

        if (blank($credentials)) {
            $this->messages[] = 'GA_CREDENTIALS belum diisi.';

            return false;
        }

        if (! is_file($this->credentialsPath())) {
            $this->messages[] = 'File service account Google Analytics tidak ditemukan: ' . $credentials;
        }

        return filled($propertyId) && filled($credentials) && is_file($this->credentialsPath());
    }

    private function canConnectToSearchConsole(): bool
    {
        $credentials = env('GA_CREDENTIALS');
        $siteUrl = env('GSC_SITE_URL');

        if (blank($siteUrl)) {
            $this->searchConsoleMessages[] = 'GSC_SITE_URL belum diisi.';
        }

        if (blank($credentials)) {
            $this->searchConsoleMessages[] = 'GA_CREDENTIALS belum diisi.';

            return false;
        }

        if (! is_file($this->credentialsPath())) {
            $this->searchConsoleMessages[] = 'File service account Google tidak ditemukan: ' . $credentials;
        }

        return filled($siteUrl) && filled($credentials) && is_file($this->credentialsPath());
    }

    private function runReport(array $payload): ?array
    {
        return $this->postAnalytics('runReport', $payload);
    }

    private function runRealtimeReport(array $payload): ?array
    {
        return $this->postAnalytics('runRealtimeReport', $payload);
    }

    private function postAnalytics(string $method, array $payload): ?array
    {
        try {
            $token = $this->accessToken('https://www.googleapis.com/auth/analytics.readonly', 'analytics');

            if (! $token) {
                return null;
            }

            $propertyId = env('GA_PROPERTY_ID');
            $response = Http::withToken($token)
                ->acceptJson()
                ->timeout(10)
                ->post("https://analyticsdata.googleapis.com/v1beta/properties/{$propertyId}:{$method}", $payload);

            if ($response->failed()) {
                $message = data_get($response->json(), 'error.message', $response->body());
                $this->messages[] = 'Google Analytics API gagal: ' . str($message)->limit(180);

                return null;
            }

            return $response->json();
        } catch (Throwable $e) {
            $this->messages[] = 'Google Analytics API gagal: ' . $e->getMessage();

            return null;
        }
    }

    private function accessToken(string $scope, string $context): ?string
    {
        $credentials = $this->credentials();

        if (! $credentials) {
            return null;
        }

        $cacheKey = 'google_access_token_' . md5($credentials['client_email'] . $scope);

        return Cache::remember($cacheKey, 3300, function () use ($credentials, $scope, $context) {
            try {
                $response = Http::asForm()
                    ->timeout(10)
                    ->post('https://oauth2.googleapis.com/token', [
                        'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                        'assertion' => $this->jwtAssertion($credentials, $scope),
                    ]);
            } catch (Throwable $e) {
                $this->addTokenMessage($context, 'Gagal mengambil Google access token: ' . $e->getMessage());

                return null;
            }

            if ($response->failed()) {
                $message = data_get($response->json(), 'error_description', $response->body());
                $this->addTokenMessage($context, 'Gagal mengambil Google access token: ' . str($message)->limit(180));

                return null;
            }

            return $response->json('access_token');
        });
    }

    private function addTokenMessage(string $context, string $message): void
    {
        if ($context === 'search-console') {
            $this->searchConsoleMessages[] = $message;

            return;
        }

        $this->messages[] = $message;
    }

    private function jwtAssertion(array $credentials, string $scope): string
    {
        $now = time();
        $header = $this->base64UrlEncode(json_encode([
            'alg' => 'RS256',
            'typ' => 'JWT',
        ]));
        $claim = $this->base64UrlEncode(json_encode([
            'iss' => $credentials['client_email'],
            'scope' => $scope,
            'aud' => 'https://oauth2.googleapis.com/token',
            'iat' => $now,
            'exp' => $now + 3600,
        ]));

        if (! openssl_sign($header . '.' . $claim, $signature, $credentials['private_key'], OPENSSL_ALGO_SHA256)) {
            throw new \RuntimeException('Private key service account Google Analytics tidak valid.');
        }

        return $header . '.' . $claim . '.' . $this->base64UrlEncode($signature);
    }

    private function credentials(): ?array
    {
        try {
            $credentials = json_decode(file_get_contents($this->credentialsPath()), true, 512, JSON_THROW_ON_ERROR);
        } catch (Throwable $e) {
            $this->messages[] = 'File service account Google Analytics tidak bisa dibaca: ' . $e->getMessage();

            return null;
        }

        foreach (['client_email', 'private_key'] as $key) {
            if (blank($credentials[$key] ?? null)) {
                $this->messages[] = "File service account Google Analytics tidak memiliki {$key}.";

                return null;
            }
        }

        return $credentials;
    }

    private function credentialsPath(): string
    {
        $path = (string) env('GA_CREDENTIALS');

        return str_starts_with($path, DIRECTORY_SEPARATOR) ? $path : base_path($path);
    }

    private function base64UrlEncode(string $value): string
    {
        return rtrim(strtr(base64_encode($value), '+/', '-_'), '=');
    }
}
