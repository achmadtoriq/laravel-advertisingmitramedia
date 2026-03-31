<x-layout-dashboard>

    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-lg font-semibold mb-6">
        Create Artikel
    </h2>

    <form method="POST" action="/admin/article" enctype="multipart/form-data">
        @csrf

        <!-- TITLE -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Title</label>

            <input id="title" name="title" type="text" value="{{ old('title') }}"
                class="w-full border border-gray-300 rounded-sm px-4 py-2" required>

            @error('title')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- SLUG -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Slug</label>

            <input id="slug" name="slug" type="text" value="{{ old('slug') }}"
                class="w-full border border-gray-300 rounded-sm px-4 py-2">

            @error('slug')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- TAG -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Tag</label>

            <select id="tags" name="tags[]" multiple class="w-full rounded-sm border border-gray-300">
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- IMAGE -->
        <div x-data="{ image: null }" class="mb-6">
            <label class="block text-sm font-medium mb-2">Thumbnail</label>

            <input x-ref="file" type="file" name="image" accept="image/*"
                @change="image = URL.createObjectURL($event.target.files[0])"
                class="w-full border border-gray-300 rounded-sm px-4 py-2">

            <div x-show="image" class="mt-4 relative inline-block">
                <img :src="image" class="w-40 h-28 object-cover rounded-lg border shadow">

                <button type="button" @click="image = null; $refs.file.value=''"
                    class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 text-sm">
                    ✕
                </button>
            </div>

            @error('image')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <!-- CONTENT -->
        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">Content</label>

            <div class="ck-content">
                <textarea id="editor" name="content"></textarea>
            </div>

        </div>

        <!-- SEO TITLE -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">SEO Title</label>

            <input name="seo_title" type="text" value="{{ old('seo_title') }}"
                class="w-full border border-gray-300 rounded-sm px-4 py-2">
        </div>

        <!-- SEO DESCRIPTION -->
        <div class="mb-6">
            <label class="block text-sm font-medium mb-2">SEO Description</label>

            <textarea name="seo_description" rows="3" class="w-full border border-gray-300 rounded-sm px-4 py-2">{{ old('seo_description') }}</textarea>
        </div>

        <!-- BUTTON -->
        <div class="flex gap-3">
            <button class="bg-blue-500 text-white px-6 py-2 cursor-pointer rounded-sm hover:bg-blue-600">
                Save Article
            </button>

            <a href="/admin/article" class="px-6 py-2 border border-gray-300 rounded-sm">
                Cancel
            </a>
        </div>
    </form>
</x-layout-dashboard>


{{-- <script src="/tinymce/tinymce.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-script-editor />

<!-- CDN CKEditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        ClassicEditor
            .create(document.querySelector('#editor'), {
                image: {
                    toolbar: [
                        'imageStyle:alignLeft',
                        'imageStyle:alignCenter',
                        'imageStyle:alignRight',
                        '|',
                        'resizeImage'
                    ],
                    resizeOptions: [{
                            name: 'resizeImage:original',
                            label: 'Original',
                            value: null
                        },
                        {
                            name: 'resizeImage:50',
                            label: '50%',
                            value: '50'
                        },
                        {
                            name: 'resizeImage:75',
                            label: '75%',
                            value: '75'
                        }
                    ]
                },
                ckfinder: {
                    uploadUrl: "/admin/article/upload-image?_token={{ csrf_token() }}"
                }
            })
            .catch(error => console.error(error));
    });
</script>
