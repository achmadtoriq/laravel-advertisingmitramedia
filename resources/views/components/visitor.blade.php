<div x-data="{ open: false }" class="fixed left-6 bottom-6 z-50">

    <!-- PANEL -->
    <div x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        @click.outside="open=false"
        class="mb-4 w-64 backdrop-blur-lg bg-white/80 border border-white/40 rounded-2xl shadow-2xl p-4 text-sm">

        <h3 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
            <i class="fa-solid fa-chart-simple text-red-500"></i>
            Website Stats
        </h3>

        <div class="space-y-2">

            <div class="flex justify-between items-center">
                <span class="text-gray-600">Today</span>
                <span class="font-bold text-red-500 text-lg">
                    {{ number_format($todayVisitors ?? 0) }}
                </span>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-gray-600">Yesterday</span>
                <span class="font-semibold text-gray-800">
                    {{ number_format($yesterdayVisitors ?? 0) }}
                </span>
            </div>

            <div class="flex justify-between items-center">
                <span class="text-gray-600">Last 7 Days</span>
                <span class="font-semibold text-gray-800">
                    {{ number_format($last7DaysVisitors ?? 0) }}
                </span>
            </div>

        </div>

    </div>

    <!-- BUTTON -->
    <button @click="open=!open"
        class="w-14 h-14 bg-red-600 text-white rounded-full shadow-xl flex items-center justify-center hover:scale-110 hover:rotate-45 transition duration-300">

        <i class="fa-solid fa-gear text-xl"></i>

    </button>

</div>