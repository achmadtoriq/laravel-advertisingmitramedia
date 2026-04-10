<x-layout-dashboard>

    {{-- 🔢 STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

        <div class="bg-white shadow rounded-xl p-4">
            <p class="text-sm text-gray-500">Realtime Users</p>
            <h2 class="text-2xl font-bold">{{ $realtime }}</h2>
        </div>

        <div class="bg-white shadow rounded-xl p-4">
            <p class="text-sm text-gray-500">Hari Ini</p>
            <h2 class="text-2xl font-bold">{{ collect($today)->sum('users') }}</h2>
        </div>

        <div class="bg-white shadow rounded-xl p-4">
            <p class="text-sm text-gray-500">Kemarin</p>
            <h2 class="text-2xl font-bold">{{ collect($yesterday)->sum('users') }}</h2>
        </div>

    </div>

    {{-- 📊 GRAFIK --}}
    <div class="bg-white shadow rounded-xl p-6 mb-6">
        <h2 class="text-lg font-semibold mb-4">Traffic 7 Hari Terakhir</h2>

        <div class="h-64">
            <canvas id="visitorChart"></canvas>
        </div>
    </div>

    {{-- 🎉 WELCOME --}}
    <div class="text-center mt-10 opacity-70">
        <img src="{{ asset('assets/images/mitramedia.webp') }}" class="mx-auto mb-4 w-40" alt="">
        <h1 class="text-xl font-semibold">Dashboard Mitramedia Advertising</h1>
    </div>

    {{-- 📦 CHART SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('visitorChart').getContext('2d');

        // 🎨 Gradient
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(59, 130, 246, 0.4)');
        gradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels), // contoh: ['01/04','02/04']
                datasets: [{
                    label: 'Visitors',
                    data: @json($data), // contoh: [10,20,15]
                    borderColor: '#3b82f6',
                    backgroundColor: gradient,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 3,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#3b82f6',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,

                animation: {
                    duration: 1000,
                    easing: 'easeOutQuart'
                },

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
                                return ' ' + context.raw + ' visitors';
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
                            stepSize: 2
                        }
                    }
                }
            }
        });
    </script>

</x-layout-dashboard>