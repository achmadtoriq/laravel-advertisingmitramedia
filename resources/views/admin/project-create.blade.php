<x-layout-dashboard>

    @push('cropper')
        <link href="https://unpkg.com/cropperjs@1.5.13/dist/cropper.css" rel="stylesheet">
        <script src="https://unpkg.com/cropperjs@1.5.13/dist/cropper.min.js"></script>
    @endpush

    <!-- ALERT -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-lg font-semibold mb-6">
        Upload Project
    </h2>

    <form method="POST" action="{{ route('projects.store') }}">
        @csrf

        <!-- TITLE -->
        <div class="mb-4 grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Title</label>
                <input id="title" name="title" type="text" value="{{ old('title') }}"
                    class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Lokasi</label>
                <input id="location" name="location" type="text" value="{{ old('location') }}"
                    class="w-full border border-gray-300 rounded px-4 py-2" required>
            </div>
        </div>

        <!-- SLUG -->
        <div class="mb-4">
            <label class="block text-sm font-medium mb-2">Slug</label>
            <input id="slug" name="slug" type="text" value="{{ old('slug') }}"
                class="w-full border border-gray-300 rounded px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold mb-3">Category</label>
        
            <div class="flex flex-wrap gap-3">
        
                <!-- ITEM -->
                <label class="cursor-pointer">
                    <input type="radio" name="category" value="neonbox" class="hidden peer" checked>
        
                    <div
                        class="px-4 py-2 rounded-lg border border-gray-300 
                        peer-checked:bg-red-500 peer-checked:text-white peer-checked:font-medium 
                        hover:border-red-400 transition">
                        Neon Box
                    </div>
                </label>
        
                <label class="cursor-pointer">
                    <input type="radio" name="category" value="billboard" class="hidden peer">
        
                    <div
                        class="px-4 py-2 rounded-lg border border-gray-300 
                        peer-checked:bg-red-500 peer-checked:text-white peer-checked:font-medium 
                        hover:border-red-400 transition">
                        Billboard
                    </div>
                </label>
        
                <label class="cursor-pointer">
                    <input type="radio" name="category" value="huruf-timbul" class="hidden peer">
        
                    <div
                        class="px-4 py-2 rounded-lg border border-gray-300 
                        peer-checked:bg-red-500 peer-checked:text-white peer-checked:font-medium 
                        hover:border-red-400 transition">
                        Huruf Timbul
                    </div>
                </label>
        
                <label class="cursor-pointer">
                    <input type="radio" name="category" value="indoor-outdoor" class="hidden peer">
        
                    <div
                        class="px-4 py-2 rounded-lg border border-gray-300 
                        peer-checked:bg-red-500 peer-checked:text-white peer-checked:font-medium 
                        hover:border-red-400 transition">
                        Indoor / Outdoor
                    </div>
                </label>
        
            </div>
        </div>

        <!-- IMAGE CROP REALTIME -->
        <div x-data="imageCropper()" class="mb-6">

            <label class="block text-sm font-semibold mb-2">Upload & Crop Gambar</label>

            <div class="flex items-end gap-4">
                <input type="file" accept="image/*" @change="loadImage"
                    class="block text-sm border border-gray-300 rounded-lg p-2">

                <!-- RATIO -->
                <div class="mt-3">
                    <label class="text-sm">Aspect Ratio</label>
                    <select x-model="ratio" @change="initCropper" class="border border-gray-300 px-3 py-2 rounded">
                        <option value="1">1:1 (Square)</option>
                        <option value="1.777">16:9 (Banner)</option>
                        <option value="0">Free</option>
                    </select>
                </div>
            </div>

            <!-- AREA CROP -->
            <div class="mt-4">
                <img x-ref="image" class="max-w-full hidden rounded shadow">
            </div>

            <!-- PREVIEW -->
            <template x-if="preview">
                <div class="mt-4">
                    <p class="text-sm text-gray-500 mb-1">Preview</p>
                    <img :src="preview" class="w-40 rounded shadow">
                </div>
            </template>



            <!-- HIDDEN -->
            <input type="hidden" name="cropped_image" x-model="cropped">
        </div>

        <!-- BUTTON -->
        <div class="flex gap-3">
            <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Save Project
            </button>

            <a href="/projects" class="px-6 py-2 border rounded">
                Cancel
            </a>
        </div>

    </form>

</x-layout-dashboard>

<script>
    const title = document.getElementById('title');
    const slug = document.getElementById('slug');

    title.addEventListener('keyup', function() {

        slug.value = title.value
            .toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');

    });

    function imageCropper() {
        return {
            cropper: null,
            preview: null,
            cropped: null,
            ratio: 1,

            loadImage(e) {
                const file = e.target.files[0];
                if (!file) return;

                const url = URL.createObjectURL(file);

                this.$refs.image.src = url;
                this.$refs.image.classList.remove('hidden');

                this.initCropper();
            },

            initCropper() {
                if (this.cropper) this.cropper.destroy();

                this.cropper = new Cropper(this.$refs.image, {
                    aspectRatio: this.ratio == 0 ? NaN : parseFloat(this.ratio),
                    viewMode: 1,
                    autoCropArea: 1,

                    crop: () => {
                        this.generateCrop();
                    }
                });
            },

            generateCrop() {
                if (!this.cropper) return;

                const canvas = this.cropper.getCroppedCanvas({
                    width: 800,
                    height: 800
                });

                this.preview = canvas.toDataURL('image/png');
                this.cropped = this.preview;
            }
        }
    }
</script>
