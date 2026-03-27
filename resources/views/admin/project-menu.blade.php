<x-layout-dashboard>

    <div class="flex justify-between items-center mb-4">

        <h2 class="text-lg font-semibold">
            Daftar Project
        </h2>

        <a href="/admin/projects/create" class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600">
            Tambah
        </a>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-6">
        @foreach ($project as $p)
            <div id="{{ 'project-'.$p->id }}" class="bg-white rounded-md shadow hover:shadow-lg transition overflow-hidden relative">

                <!-- ICON HAPUS -->
                <button onclick="confirmDelete({{ $p->id }})"
                    class="absolute top-2 right-2 z-10 bg-red-500 cursor-pointer text-white w-8 h-8 flex items-center justify-center rounded-full shadow hover:bg-red-600 transition">
                
                    <i class="fa-solid fa-trash-can text-sm"></i>
                </button>

                <!-- IMAGE -->
                <img src="{{ $p->image }}" class="w-full h-40 object-cover">

                <!-- CONTENT -->
                <div class="p-4">
                    <h3 class="text-sm font-semibold mb-1">
                        {{ $p->title }}
                    </h3>

                    <p class="text-sm text-gray-500 mb-3">
                        {{ $p->location }} • {{ $p->category }}
                    </p>
                </div>

            </div>
        @endforeach
    </div>

    <!-- PAGINATION -->
    <div class="mt-6">

        {{-- {{ $articles->links() }} --}}

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
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin hapus project ini?',
            text: "Data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {

                fetch(`/admin/projects/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => res.json())
                    .then(res => {
                        Swal.fire('Berhasil!', res.message, 'success');

                        // hapus card dari tampilan
                        document.getElementById('project-' + id).remove();
                    })
                    .catch(err => {
                        Swal.fire('Error!', 'Gagal menghapus data', 'error');
                    });

            }
        });
    }
</script>
