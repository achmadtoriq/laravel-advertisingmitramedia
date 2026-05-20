<x-layout>
    <x-slot:title>Artikel Mitramedia Advertising | Jasa Reklame Surabaya</x-slot:title>
    <x-slot:description>Tips neon box, papan reklame, huruf timbul, dan media promosi outdoor dari Mitramedia Advertising Surabaya.</x-slot:description>
    <x-slot:keyword>artikel neon box surabaya, tips reklame surabaya, papan reklame surabaya, huruf timbul surabaya, jasa reklame surabaya</x-slot:keyword>

    <x-slot:OgMeta>
        <meta property="og:title" content="Artikel Mitramedia Advertising">
        <meta property="og:description"
            content="Tips neon box, papan reklame, huruf timbul, dan media promosi outdoor dari Mitramedia Advertising Surabaya.">
        <meta property="og:image" content="{{ asset('assets/images/about-img.webp') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
    </x-slot:OgMeta>

    <x-slot:TwitterMeta>
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Artikel Mitramedia Advertising">
        <meta name="twitter:description"
            content="Tips neon box, papan reklame, huruf timbul, dan media promosi outdoor dari Mitramedia Advertising Surabaya.">
        <meta name="twitter:image" content="{{ asset('assets/images/about-img.webp') }}">
    </x-slot:TwitterMeta>

    <section class="relative py-28 text-white text-center overflow-hidden">

        <!-- Background Gradient -->
        <div class="absolute inset-0 bg-gradient-to-r from-red-800 via-red-600 to-orange-500"></div>

        <!-- Glow Effect -->
        <div class="absolute -top-32 -left-32 w-96 h-96 bg-orange-400/30 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-red-500/30 blur-[120px] rounded-full"></div>

        <!-- Content -->
        <div class="relative max-w-5xl mx-auto px-6">

            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Artikel Mitramedia Advertising
            </h1>

            <p class="text-white/90">
                Tips neon box, papan reklame, dan huruf timbul Surabaya
            </p>

        </div>

    </section>

    <x-artikel></x-artikel>

</x-layout>
