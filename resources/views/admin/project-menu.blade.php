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
            <div class="bg-white rounded-md shadow hover:shadow-lg transition overflow-hidden">
                <img src="{{ $p->image }}" class="w-full h-40 object-cover">
    
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


