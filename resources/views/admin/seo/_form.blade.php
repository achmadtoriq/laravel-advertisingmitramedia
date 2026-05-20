@csrf

@if ($method !== 'POST')
    @method($method)
@endif

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-600 mb-2">Nama Halaman</label>
        <input type="text" name="name" value="{{ old('name', $seo->name) }}"
            class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none focus:ring-2 focus:ring-red-500">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-600 mb-2">Route Path</label>
        <input type="text" name="path" value="{{ old('path', $seo->path) }}"
            class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none focus:ring-2 focus:ring-red-500">
        <p class="mt-1 text-xs text-gray-500">Contoh: /about-us, /promo-neon-box, atau /artikel/* untuk pattern.</p>
    </div>
</div>

<div>
    <label class="block text-sm font-semibold text-gray-600 mb-2">View / Handler</label>
    <input type="text" name="view_name" value="{{ old('view_name', $seo->view_name) }}"
        class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none focus:ring-2 focus:ring-red-500">
    <p class="mt-1 text-xs text-gray-500">Gunakan view Blade seperti pages.home, pages.project, atau handler khusus article_detail.</p>
</div>

<div class="rounded-lg border border-blue-100 bg-blue-50 px-4 py-3 text-sm text-blue-800">
    Untuk route pattern seperti /artikel/*, field meta bisa memakai token <strong>{title}</strong>,
    <strong>{description}</strong>, <strong>{keywords}</strong>, dan <strong>{site}</strong>.
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-gray-600 mb-2">Meta Title</label>
        <input type="text" name="meta_title" value="{{ old('meta_title', $seo->meta_title) }}"
            class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none focus:ring-2 focus:ring-red-500">
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-600 mb-2">Robots</label>
        <input type="text" name="robots" value="{{ old('robots', $seo->robots ?: 'index, follow') }}"
            class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none focus:ring-2 focus:ring-red-500">
    </div>
</div>

<div>
    <label class="block text-sm font-semibold text-gray-600 mb-2">Meta Description</label>
    <textarea name="meta_description" rows="3"
        class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none focus:ring-2 focus:ring-red-500">{{ old('meta_description', $seo->meta_description) }}</textarea>
</div>

<div>
    <label class="block text-sm font-semibold text-gray-600 mb-2">Meta Keywords</label>
    <textarea name="meta_keywords" rows="2"
        class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none focus:ring-2 focus:ring-red-500">{{ old('meta_keywords', $seo->meta_keywords) }}</textarea>
</div>

<div class="border-t pt-6">
    <h3 class="font-semibold text-gray-700 mb-4">Open Graph</h3>

    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2">OG Title</label>
            <input type="text" name="og_title" value="{{ old('og_title', $seo->og_title) }}"
                class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2">OG Image URL</label>
            <input type="text" name="og_image" value="{{ old('og_image', $seo->og_image) }}"
                class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none focus:ring-2 focus:ring-red-500">
        </div>
    </div>

    <div class="mt-4">
        <label class="block text-sm font-semibold text-gray-600 mb-2">OG Description</label>
        <textarea name="og_description" rows="3"
            class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none focus:ring-2 focus:ring-red-500">{{ old('og_description', $seo->og_description) }}</textarea>
    </div>
</div>

<div class="border-t pt-6">
    <h3 class="font-semibold text-gray-700 mb-4">Twitter Card</h3>

    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2">Twitter Title</label>
            <input type="text" name="twitter_title" value="{{ old('twitter_title', $seo->twitter_title) }}"
                class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none focus:ring-2 focus:ring-red-500">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-600 mb-2">Twitter Image URL</label>
            <input type="text" name="twitter_image" value="{{ old('twitter_image', $seo->twitter_image) }}"
                class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none focus:ring-2 focus:ring-red-500">
        </div>
    </div>

    <div class="mt-4">
        <label class="block text-sm font-semibold text-gray-600 mb-2">Twitter Description</label>
        <textarea name="twitter_description" rows="3"
            class="w-full rounded-lg border border-gray-200 px-4 py-3 outline-none focus:ring-2 focus:ring-red-500">{{ old('twitter_description', $seo->twitter_description) }}</textarea>
    </div>
</div>

<label class="inline-flex items-center gap-2 text-sm text-gray-700">
    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $seo->is_active ?? true))
        class="rounded border-gray-300 text-red-600 focus:ring-red-500">
    Aktif
</label>

<div class="flex justify-end gap-3">
    <a href="/admin/seo" class="rounded-lg border px-4 py-2 text-gray-600 hover:bg-gray-50">Batal</a>
    <button type="submit" class="rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700">
        Simpan
    </button>
</div>
