<x-layout>
    <x-slot:title>{{ $article['seo_title'] ?? 'Artikel Mitramedia Arvertising'}}</x-slot:title>
    <x-slot:description>{{ $article['seo_description'] ?? 'Artikel Mitramedia Arvertising' }}</x-slot:description>
    <x-slot:keyword>portfolio neon box surabaya, project papan reklame surabaya, huruf timbul surabaya, jasa reklame
        surabaya, contoh neon box surabaya</x-slot:keyword>

    <x-slot:OgMeta>
        <meta property="og:title" content="Jasa Reklame Surabaya">
        <meta property="og:description"
            content="Hubungi Mitramedia Advertising untuk jasa neon box, papan reklame, dan huruf timbul di Surabaya. Konsultasi desain reklame profesional untuk bisnis Anda.">
        <meta property="og:image" content="{{ asset('assets/images/about-img.webp') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:type" content="website">
    </x-slot:OgMeta>

    <x-slot:TwitterMeta>
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="Jasa Reklame Surabaya">
        <meta name="twitter:description"
            content="Hubungi Mitramedia Advertising untuk jasa neon box, papan reklame, dan huruf timbul di Surabaya. Konsultasi desain reklame profesional untuk bisnis Anda.">
        <meta name="twitter:image" content="{{ asset('assets/images/about-img.webp') }}">
    </x-slot:TwitterMeta>

    <section class="max-w-4xl mx-auto px-6 py-20 my-16">

        {{-- Breadcrumb --}}
        <div class="text-sm text-gray-400 mb-6">

            <a href="/" class="hover:text-red-600">Home</a> /
            <a href="/artikel" class="hover:text-red-600">Artikel</a> /
            <span>{{ $article['title'] }}</span>

        </div>


        {{-- Title --}}
        <h1 class="text-4xl font-bold mb-6 leading-tight">

            {{ $article['title'] }}

        </h1>


        {{-- Meta --}}
        <div class="flex gap-6 text-sm text-gray-400 mb-10">

            <span>👁 {{ $article['views'] }} views</span>

            <span>
                ⏱ {{ ceil(str_word_count(strip_tags($article['content'])) / 200) }} min read
            </span>

        </div>


        {{-- Hero Image --}}
        <img src="{{ $article['image'] }}" class="w-full rounded-xl mb-12 shadow-lg">


        {{-- Content --}}
        <div
            class="prose max-w-none
                    prose-headings:font-bold
                    prose-h1:text-3xl
                    prose-h2:text-2xl
                    prose-h3:text-xl

                    prose-p:text-gray-700

                    prose-a:text-blue-600
                    prose-a:no-underline
                    hover:prose-a:underline

                    prose-ul:list-disc
                    prose-ul:pl-5

                    prose-li:ml-5

                    prose-ol:list-decimal
                    prose-ol:pl-5

                    prose-li:marker:text-gray-500

                    prose-img:rounded-lg
                    prose-img:shadow
                    prose-img:my-4
                    prose-img:mx-auto

                    prose-blockquote:border-l-4
                    prose-blockquote:border-gray-300
                    prose-blockquote:pl-4
                    prose-blockquote:text-gray-600

                    prose-strong:text-gray-900
                    prose-strong:font-semibold

                    prose-table:border
                    prose-table:border-gray-300
                    prose-th:bg-gray-100
                    prose-th:p-2
                    prose-td:p-2

                    prose-code:bg-gray-100
                    prose-code:px-1
                    prose-code:rounded

                    prose-pre:bg-gray-900
                    prose-pre:text-white
                    prose-pre:rounded-lg
                    prose-pre:p-4">

            {!! $article['content'] !!}

        </div>


        {{-- Tags --}}
        <div class="mt-12 flex flex-wrap gap-2">

            @foreach ($article['tags'] as $tag)
                <span class="text-xs bg-red-100 text-red-600 px-3 py-1 rounded-full">
                    #{{ $tag }}
                </span>
            @endforeach

        </div>


        {{-- Share --}}
        <div class="mt-16 border-t pt-10">

            <h3 class="font-semibold mb-4">

                Bagikan Artikel

            </h3>

            <div class="flex gap-4">

                <a href="#" class="px-4 py-2 bg-blue-500 text-white rounded">
                    Facebook
                </a>

                <a href="#" class="px-4 py-2 bg-green-500 text-white rounded">
                    WhatsApp
                </a>

                <a href="#" class="px-4 py-2 bg-black text-white rounded">
                    Twitter
                </a>

            </div>

        </div>

    </section>

</x-layout>
