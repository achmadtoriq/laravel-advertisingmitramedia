<div x-data="{ open:false, pinned:false }"
     @mouseenter="if(!pinned) open=true"
     @mouseleave="if(!pinned) open=false"
     class="fixed left-6 bottom-6 z-50">

    <!-- PANEL -->
    <div x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-3"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-3"
        @click.outside="open=false; pinned=false"
        class="mb-4 w-72 backdrop-blur-md bg-white/90 border border-gray-200 rounded-2xl shadow-2xl p-5 text-sm">

        <div class="flex justify-between items-center mb-4">

            <h3 class="font-semibold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-chart-line text-red-500"></i>
                Website Analytics
            </h3>

            <button
                @click="pinned=!pinned"
                class="text-gray-400 hover:text-red-500 transition">

                <i class="fa-solid"
                   :class="pinned ? 'fa-lock' : 'fa-thumbtack'"></i>

            </button>

        </div>

        <div class="space-y-3">

            <div class="flex justify-between items-center">
                <span class="text-gray-600">Realtime Users</span>
                <span class="font-bold text-red-500 text-lg">
                    {{ number_format($realtimeUsers ?? 0) }}
                </span>
            </div>

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
    <button
        @click="open=true; pinned=true"
        class="w-14 h-14 bg-red-600 text-white rounded-full shadow-xl cursor-pointer flex items-center justify-center hover:scale-110 hover:rotate-45 transition duration-300">

        <i class="fa-solid fa-gear text-xl"></i>

    </button>

</div>