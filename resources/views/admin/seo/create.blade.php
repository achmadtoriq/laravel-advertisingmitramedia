<x-layout-dashboard>

    <div class="mb-6">
        <h2 class="text-lg font-semibold">Tambah SEO Public Page</h2>
        <p class="text-sm text-gray-500">Tambahkan route publik baru yang akan dirender dari view Blade tertentu.</p>
    </div>

    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="/admin/seo" class="space-y-6">
        @include('admin.seo._form', ['method' => 'POST'])
    </form>

</x-layout-dashboard>
