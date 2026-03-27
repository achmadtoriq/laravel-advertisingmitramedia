<nav class="flex-1 p-2 space-y-1">

    @foreach ($menus as $menu)
        @if (isset($menu['submenu']))
            <div x-data="{ submenu: false }">

                <button @click="submenu=!submenu"
                    class="w-full flex items-center justify-between p-3 rounded-lg hover:bg-gray-100">

                    <div class="flex items-center gap-3">

                        <i class="{{ $menu['icon'] }} text-gray-500"></i>

                        <span x-show="open">{{ $menu['name'] }}</span>

                    </div>

                    <i x-show="open" :class="submenu ? 'fa-solid fa-chevron-up' : 'fa-solid fa-chevron-down'"
                        class="text-xs text-gray-400"></i>

                </button>

                <div x-show="submenu && open" x-transition class="ml-9 space-y-1">

                    @foreach ($menu['submenu'] as $sub)
                        <a href="{{ $sub['url'] }}" class="block p-2 text-sm rounded hover:bg-gray-100">

                            {{ $sub['name'] }}

                        </a>
                    @endforeach

                </div>

            </div>
        @else
            <a href="{{ $menu['url'] }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100">

                <i class="{{ $menu['icon'] }} text-gray-500"></i>

                <span x-show="open">{{ $menu['name'] }}</span>

            </a>
        @endif
    @endforeach

</nav>
