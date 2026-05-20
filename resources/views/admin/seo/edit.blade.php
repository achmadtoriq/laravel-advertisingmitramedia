<x-layout-dashboard>

    <div class="mb-6">
        <h2 class="text-lg font-semibold">Edit SEO: {{ $seo->name }}</h2>
        <p class="text-sm text-gray-500">Perubahan di sini langsung dipakai oleh route publik yang cocok.</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/admin/seo/{{ $seo->id }}" class="space-y-6">
        @include('admin.seo._form', ['method' => 'PUT'])
    </form>

</x-layout-dashboard>
