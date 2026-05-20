<x-layout-dashboard>

    <div class="flex justify-between items-center mb-4">
        <div>
            <h2 class="text-lg font-semibold">SEO Public Pages</h2>
            <p class="text-sm text-gray-500">Atur meta title, description, keywords, Open Graph, dan Twitter Card per route publik.</p>
        </div>

        <a href="/admin/seo/create" class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600">
            Tambah Route
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-200 text-gray-600">
                <tr>
                    <th class="px-4 py-3 text-left">Halaman</th>
                    <th class="px-4 py-3 text-left">Route</th>
                    <th class="px-4 py-3 text-left">View</th>
                    <th class="px-4 py-3 text-left">Meta Title</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pages as $page)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">{{ $page->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $page->path }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $page->view_name }}</td>
                        <td class="px-4 py-3 text-gray-500">
                            {{ $page->meta_title ?: '-' }}
                        </td>
                        <td class="px-4 py-3">
                            @if ($page->is_active)
                                <span class="rounded-full bg-green-100 px-3 py-1 text-xs text-green-700">Aktif</span>
                            @else
                                <span class="rounded-full bg-gray-100 px-3 py-1 text-xs text-gray-600">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="/admin/seo/{{ $page->id }}/edit"
                                class="inline-flex items-center rounded-lg border px-3 py-2 text-blue-600 hover:bg-blue-50">
                                Edit
                            </a>
                            <form method="POST" action="/admin/seo/{{ $page->id }}" class="inline"
                                onsubmit="return confirm('Hapus route SEO ini? Halaman publik terkait bisa menjadi 404.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center rounded-lg border px-3 py-2 text-red-600 hover:bg-red-50">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-layout-dashboard>
