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
        <canvas id="visitorChart" height="100"></canvas>
    </div>


    {{-- 🎉 WELCOME (diperkecil) --}}
    <div class="text-center mt-10 opacity-70">
        <img src="{{ asset('assets/images/mitramedia.webp') }}" class="mx-auto mb-4 w-40" alt="">
        <h1 class="text-xl font-semibold">Dashboard Mitramedia Advertising</h1>
    </div>

</x-layout-dashboard>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const chartData = @json($chart);

    const labels = chartData.map(item => {
        const d = item.date;
        return `${d.substr(6,2)}/${d.substr(4,2)}`;
    });

    const values = chartData.map(item => item.users);

    const ctx = document.getElementById('visitorChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Visitors',
                data: values,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    });
</script>
