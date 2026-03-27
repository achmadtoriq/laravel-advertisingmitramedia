@php
    $segments = request()->segments();
    $path = '/admin';
@endphp

<div class="mb-6 flex items-center gap-2 text-sm text-gray-500">

    <a href="/admin/dashboard" class="hover:text-gray-900 font-medium">
        Dashboard
    </a>

    @foreach ($segments as $key => $segment)
        @if ($segment !== 'dashboard' && $segment != 'admin' && !is_numeric($segment))
            @php
                $path .= '/' . $segment;
            @endphp

            <i class="fa-solid fa-angle-right text-xs text-gray-400"></i>

            @if ($loop->last)
                <span class="capitalize text-gray-700 font-medium">
                    {{ str_replace('-', ' ', $segment) }}
                </span>
            @else
                <a href="{{ $path }}" class="capitalize hover:text-black">
                    {{ str_replace('-', ' ', $segment) }}
                </a>
            @endif
        @endif
    @endforeach

</div>
