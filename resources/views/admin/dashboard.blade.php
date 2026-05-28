<x-layout-dashboard>

    <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Dashboard</h2>
            <p class="text-sm text-gray-500">Ringkasan traffic website dari Google Analytics.</p>
        </div>

        <div class="inline-flex w-fit items-center gap-2 rounded-lg px-3 py-2 text-sm
            {{ $gaEnabled && empty($gaMessages) ? 'bg-green-50 text-green-700' : 'bg-yellow-50 text-yellow-700' }}">
            <span class="h-2 w-2 rounded-full {{ $gaEnabled && empty($gaMessages) ? 'bg-green-500' : 'bg-yellow-500' }}"></span>
            {{ $gaEnabled && empty($gaMessages) ? 'Google Analytics aktif' : 'Google Analytics perlu dicek' }}
        </div>
    </div>

    @if (! $gaEnabled || ! empty($gaMessages))
        <div class="mb-6 rounded-lg border border-yellow-200 bg-yellow-50 px-4 py-3 text-sm text-yellow-800">
            <p class="font-medium">Data Google Analytics belum bisa ditampilkan.</p>
            <ul class="mt-2 list-disc space-y-1 pl-5">
                @forelse ($gaMessages as $message)
                    <li>{{ $message }}</li>
                @empty
                    <li>Lengkapi <code>GA_CREDENTIALS</code> dan <code>GA_PROPERTY_ID</code> agar data Google Analytics tampil.</li>
                @endforelse
            </ul>
        </div>
    @endif

    <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-lg border border-gray-100 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">Realtime Users</p>
                <i class="fa-solid fa-signal text-green-500"></i>
            </div>
            <h3 class="mt-3 text-3xl font-bold text-gray-900">{{ number_format($realtime) }}</h3>
            <p class="mt-1 text-xs text-gray-400">Aktif saat ini</p>
        </div>

        <div class="rounded-lg border border-gray-100 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">Hari Ini</p>
                <i class="fa-solid fa-calendar-day text-blue-500"></i>
            </div>
            <h3 class="mt-3 text-3xl font-bold text-gray-900">{{ number_format($today) }}</h3>
            <p class="mt-1 text-xs {{ $dailyChange >= 0 ? 'text-green-600' : 'text-red-600' }}">
                {{ $dailyChange >= 0 ? '+' : '' }}{{ number_format($dailyChange) }} dari kemarin
            </p>
        </div>

        <div class="rounded-lg border border-gray-100 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">Kemarin</p>
                <i class="fa-solid fa-clock-rotate-left text-orange-500"></i>
            </div>
            <h3 class="mt-3 text-3xl font-bold text-gray-900">{{ number_format($yesterday) }}</h3>
            <p class="mt-1 text-xs text-gray-400">Total users kemarin</p>
        </div>

        <div class="rounded-lg border border-gray-100 bg-white p-5 shadow-sm">
            <div class="flex items-center justify-between">
                <p class="text-sm font-medium text-gray-500">7 Hari Terakhir</p>
                <i class="fa-solid fa-chart-line text-red-500"></i>
            </div>
            <h3 class="mt-3 text-3xl font-bold text-gray-900">{{ number_format($last7Days) }}</h3>
            <p class="mt-1 text-xs text-gray-400">Akumulasi active users</p>
        </div>
    </div>

    <div class="mb-6 rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
        <div class="mb-5">
            <h2 class="text-lg font-semibold text-gray-800">Konversi & Artikel</h2>
            <p class="text-sm text-gray-500">Klik kontak tercatat untuk 28 hari terakhir. View artikel merupakan total sepanjang waktu.</p>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="rounded-lg border border-green-100 bg-green-50 p-5">
                <p class="text-sm font-medium text-green-700">Klik WhatsApp</p>
                <h3 class="mt-3 text-3xl font-bold text-gray-900">{{ number_format($conversions['whatsapp']) }}</h3>
                <p class="mt-1 text-xs text-gray-500">28 hari terakhir</p>
            </div>

            <div class="rounded-lg border border-blue-100 bg-blue-50 p-5">
                <p class="text-sm font-medium text-blue-700">Klik Telepon</p>
                <h3 class="mt-3 text-3xl font-bold text-gray-900">{{ number_format($conversions['phone']) }}</h3>
                <p class="mt-1 text-xs text-gray-500">28 hari terakhir</p>
            </div>

            <div class="rounded-lg border border-orange-100 bg-orange-50 p-5">
                <p class="text-sm font-medium text-orange-700">View Artikel</p>
                <h3 class="mt-3 text-3xl font-bold text-gray-900">{{ number_format($conversions['article_views']) }}</h3>
                <p class="mt-1 text-xs text-gray-500">Total seluruh artikel</p>
            </div>
        </div>
    </div>

    <div class="mb-6 rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
        <div class="mb-5 flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">SEO Issues</h2>
                <p class="text-sm text-gray-500">Checklist cepat dari meta SEO halaman publik dan artikel.</p>
            </div>
        </div>

        @if (count($seoIssues))
            <div class="grid grid-cols-1 gap-3 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($seoIssues as $issue)
                    <a href="{{ $issue['url'] }}" class="flex items-center justify-between rounded-lg border border-gray-100 bg-gray-50 px-4 py-3 hover:border-red-200 hover:bg-red-50">
                        <div>
                            <p class="text-sm font-medium text-gray-800">{{ $issue['label'] }}</p>
                            <p class="mt-1 text-xs text-gray-500">Klik untuk perbaiki</p>
                        </div>
                        <span class="rounded-full px-3 py-1 text-sm font-semibold
                            {{ $issue['count'] > 0 && $issue['level'] === 'danger' ? 'bg-red-100 text-red-700' : '' }}
                            {{ $issue['count'] > 0 && $issue['level'] === 'warning' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ $issue['count'] === 0 ? 'bg-green-100 text-green-700' : '' }}">
                            {{ number_format($issue['count']) }}
                        </span>
                    </a>
                @endforeach
            </div>
        @else
            <div class="rounded-lg border border-dashed border-gray-200 bg-gray-50 px-4 py-6 text-center text-sm text-gray-500">
                Data SEO lokal belum tersedia.
            </div>
        @endif
    </div>

    <div class="rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
        <div class="mb-5 flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Traffic 7 Hari Terakhir</h2>
                <p class="text-sm text-gray-500">Active users harian dari Google Analytics.</p>
            </div>
        </div>

        <div class="relative h-72">
            @if (count($data))
                <canvas id="visitorChart"></canvas>
            @else
                <div class="flex h-full items-center justify-center rounded-lg border border-dashed border-gray-200 bg-gray-50 text-sm text-gray-500">
                    Data traffic belum tersedia.
                </div>
            @endif
        </div>
    </div>

    <div class="mt-6 rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
        <div class="mb-5 flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Konten Teratas</h2>
                <p class="text-sm text-gray-500">Halaman dengan views tertinggi dari Google Analytics, periode 28 hari terakhir.</p>
            </div>
        </div>

        @if (count($topContent))
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead>
                        <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="px-3 py-3">Halaman</th>
                            <th class="px-3 py-3 text-right">Views</th>
                            <th class="px-3 py-3 text-right">Users</th>
                            <th class="px-3 py-3 text-right">Avg. Durasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($topContent as $content)
                            <tr class="text-gray-700">
                                <td class="max-w-xl px-3 py-3">
                                    <a href="{{ url($content['path']) }}" target="_blank" class="font-medium text-gray-900 hover:text-red-600">
                                        {{ $content['title'] ?: $content['path'] }}
                                    </a>
                                    <p class="mt-1 truncate text-xs text-gray-500">{{ $content['path'] }}</p>
                                </td>
                                <td class="px-3 py-3 text-right">{{ number_format($content['views']) }}</td>
                                <td class="px-3 py-3 text-right">{{ number_format($content['users']) }}</td>
                                <td class="px-3 py-3 text-right">{{ gmdate('i:s', (int) round($content['avg_duration'])) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex min-h-40 items-center justify-center rounded-lg border border-dashed border-gray-200 bg-gray-50 text-sm text-gray-500">
                Data konten teratas belum tersedia.
            </div>
        @endif
    </div>

    <div class="mt-6 rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
        <div class="mb-5 flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Landing Page dari Google Search</h2>
                <p class="text-sm text-gray-500">Halaman yang paling sering mendapat klik dan impression dari Google Search Console.</p>
            </div>
        </div>

        @if (count($searchLandingPages))
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead>
                        <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="px-3 py-3">Halaman</th>
                            <th class="px-3 py-3 text-right">Clicks</th>
                            <th class="px-3 py-3 text-right">Impressions</th>
                            <th class="px-3 py-3 text-right">CTR</th>
                            <th class="px-3 py-3 text-right">Posisi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($searchLandingPages as $page)
                            <tr class="text-gray-700">
                                <td class="max-w-xl px-3 py-3">
                                    <a href="{{ $page['page'] }}" target="_blank" class="font-medium text-gray-900 hover:text-red-600">
                                        {{ parse_url($page['page'], PHP_URL_PATH) ?: $page['page'] }}
                                    </a>
                                    <p class="mt-1 truncate text-xs text-gray-500">{{ $page['page'] }}</p>
                                </td>
                                <td class="px-3 py-3 text-right">{{ number_format($page['clicks']) }}</td>
                                <td class="px-3 py-3 text-right">{{ number_format($page['impressions']) }}</td>
                                <td class="px-3 py-3 text-right">{{ number_format($page['ctr'] * 100, 2) }}%</td>
                                <td class="px-3 py-3 text-right">{{ number_format($page['position'], 1) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex min-h-40 items-center justify-center rounded-lg border border-dashed border-gray-200 bg-gray-50 text-sm text-gray-500">
                Data landing page Google Search belum tersedia.
            </div>
        @endif
    </div>

    <div class="mt-6 rounded-lg border border-gray-100 bg-white p-6 shadow-sm">
        <div class="mb-5 flex flex-col gap-1 md:flex-row md:items-center md:justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Query Penelusuran Google</h2>
                <p class="text-sm text-gray-500">Top query organik dari Google Search Console, semua data yang tersedia.</p>
            </div>
        </div>

        @if (! empty($searchConsoleMessages))
            <div class="mb-4 rounded-lg border border-yellow-200 bg-yellow-50 px-4 py-3 text-sm text-yellow-800">
                <p class="font-medium">Data query belum bisa ditampilkan.</p>
                <ul class="mt-2 list-disc space-y-1 pl-5">
                    @foreach ($searchConsoleMessages as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (count($searchQueries))
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead>
                        <tr class="text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                            <th class="px-3 py-3">Query</th>
                            <th class="px-3 py-3 text-right">Clicks</th>
                            <th class="px-3 py-3 text-right">Impressions</th>
                            <th class="px-3 py-3 text-right">CTR</th>
                            <th class="px-3 py-3 text-right">Posisi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($searchQueries as $query)
                            <tr class="text-gray-700">
                                <td class="max-w-md px-3 py-3 font-medium text-gray-900">{{ $query['query'] }}</td>
                                <td class="px-3 py-3 text-right">{{ number_format($query['clicks']) }}</td>
                                <td class="px-3 py-3 text-right">{{ number_format($query['impressions']) }}</td>
                                <td class="px-3 py-3 text-right">{{ number_format($query['ctr'] * 100, 2) }}%</td>
                                <td class="px-3 py-3 text-right">{{ number_format($query['position'], 1) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="flex min-h-40 items-center justify-center rounded-lg border border-dashed border-gray-200 bg-gray-50 text-sm text-gray-500">
                Data query penelusuran belum tersedia.
            </div>
        @endif
    </div>

    <div class="mt-8 text-center opacity-70">
        <img src="{{ asset('assets/images/mitramedia.webp') }}" class="mx-auto mb-4 w-40" alt="Mitramedia Advertising">
        <h1 class="text-xl font-semibold">Dashboard Mitramedia Advertising</h1>
    </div>

    @if (count($data))
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const ctx = document.getElementById('visitorChart').getContext('2d');
            const gradient = ctx.createLinearGradient(0, 0, 0, 300);
            gradient.addColorStop(0, 'rgba(220, 38, 38, 0.28)');
            gradient.addColorStop(1, 'rgba(220, 38, 38, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Active Users',
                        data: @json($data),
                        borderColor: '#dc2626',
                        backgroundColor: gradient,
                        fill: true,
                        tension: 0.35,
                        pointRadius: 3,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#dc2626',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: '#111827',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            padding: 10,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return ' ' + context.raw + ' active users';
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#6b7280'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#e5e7eb'
                            },
                            ticks: {
                                color: '#6b7280',
                                precision: 0
                            }
                        }
                    }
                }
            });
        </script>
    @endif

</x-layout-dashboard>
