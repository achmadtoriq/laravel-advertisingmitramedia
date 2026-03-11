<div x-data="{ open: false }" class="fixed left-6 bottom-6 z-50">

    <!-- PANEL -->
    <div x-show="open" x-transition @click.outside="open=false"
        class="mb-4 w-64 bg-white rounded-xl shadow-2xl p-4 text-sm">

        <h3 class="font-bold mb-3">Website Stats</h3>

        <div class="space-y-1">
            <div class="flex justify-between">
                <span>Today</span>
                <span>{{ $todayVisitors ?? '-' }}</span>
            </div>

            <div class="flex justify-between">
                <span>Yesterday</span>
                <span>{{ $yesterdayVisitors ?? '-' }}</span>
            </div>

            <div class="flex justify-between">
                <span>Last 7 Days</span>
                <span>{{ $last7DaysVisitors ?? '-' }}</span>
            </div>
        </div>

    </div>

    <!-- BUTTON -->
    <button @click="open=!open"
        class="w-14 h-14 bg-red-600 text-white rounded-full shadow-xl flex items-center justify-center hover:scale-110 transition">

        <i class="fa-solid fa-gear text-xl"></i>

    </button>

</div>
