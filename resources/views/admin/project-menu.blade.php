<x-layout-dashboard>

    <div class="flex justify-between items-center mb-4">

        <h2 class="text-lg font-semibold">
            Daftar Project
        </h2>

        <a href="/admin/projects/create" class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-600">
            Tambah
        </a>

    </div>

    {{-- @dd($project) --}}

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


