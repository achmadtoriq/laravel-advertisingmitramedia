<x-layout-dashboard>

    <div class="flex justify-between items-center mb-4">

        <h2 class="text-lg font-semibold">
            Daftar Artikel
        </h2>

        <a href="/admin/article/create" class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600">
            Tambah Artikel
        </a>

    </div>


    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-gray-200 text-gray-600">

                <tr>

                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Judul</th>
                    <th class="px-4 py-3 text-left">Slug</th>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-right">Action</th>

                </tr>

            </thead>


            <tbody class="">

                @foreach ($articles as $article)
                    <tr class="hover:bg-gray-50">

                        <td class="px-4 py-3">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-4 py-3 font-medium">
                            {{ $article->title }}
                        </td>

                        <td class="px-4 py-3 text-gray-500">
                            {{ $article->slug }}
                        </td>

                        <td class="px-4 py-3 text-gray-500">
                            {{ $article->created_at->format('d M Y') }}
                        </td>

                        <td class="px-4 py-3 text-right space-x-2">

                            <a href="/admin/article/{{ $article->id }}/edit" class="text-blue-500 cursor-pointer px-3 py-2 border rounded-lg hover:underline">
                                Edit
                            </a>

                            <a href="#" onclick="deleteArticle({{ $article->id }}, this)"
                                class="text-red-500 cursor-pointer px-3 py-2 border rounded-lg">
                                Delete
                            </a>

                        </td>

                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>


    <!-- PAGINATION -->
    <div class="mt-6">

        {{ $articles->links() }}

    </div>

</x-layout-dashboard>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: @json(session('success')),
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

<script>
    function deleteArticle(id, el) {
        Swal.fire({
            title: 'Yakin hapus?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {

                fetch(`/admin/article/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Gagal');
                        return res.json();
                    })
                    .then(() => {

                        // 🔥 hapus row dari table tanpa reload
                        let row = el.closest('tr');
                        row.remove();

                        Swal.fire(
                            'Terhapus!',
                            'Artikel berhasil dihapus.',
                            'success'
                        );
                    })
                    .catch(() => {
                        Swal.fire(
                            'Error!',
                            'Gagal menghapus artikel.',
                            'error'
                        );
                    });

            }
        });
    }
</script>
