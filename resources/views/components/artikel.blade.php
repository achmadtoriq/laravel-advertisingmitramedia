<div x-data="{
    search: '',
    category: 'all',
    articles: @js($articles->items())
}">

    {{-- SEARCH + FILTER --}}
    <section class="max-w-7xl mx-auto px-6 py-12">

        <div class="flex flex-col md:flex-row gap-6 justify-between">

            <div class="relative w-full md:w-1/2">

                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                <input type="text" placeholder="Cari artikel..." x-model="search"
                    class="w-full pl-12 pr-4 py-3
                            border border-gray-200
                            rounded-full
                            bg-white
                            shadow-sm
                            transition
                            focus:outline-none
                            focus:ring-2
                            focus:ring-red-500/40
                            focus:border-red-500
                            placeholder:text-gray-400">

            </div>

            <div class="flex gap-3">

                <button @click="category='all'"
                    :class="category === 'all'
                        ?
                        'bg-red-500 text-white' :
                        'bg-gray-100 text-gray-700'"
                    class="px-4 py-2 rounded-full transition cursor-pointer">

                    Semua

                </button>

                <button @click="category='neon box'"
                    :class="category === 'neon box'
                        ?
                        'bg-red-500 text-white' :
                        'bg-gray-100 text-gray-700'"
                    class="px-4 py-2 rounded-full transition cursor-pointer">

                    Neon Box

                </button>

                <button @click="category='reklame'"
                    :class="category === 'reklame'
                        ?
                        'bg-red-500 text-white' :
                        'bg-gray-100 text-gray-700'"
                    class="px-4 py-2 rounded-full transition cursor-pointer">

                    Reklame

                </button>

            </div>

        </div>

    </section>



    <div id="article-container">

        {{-- FEATURED HERO --}}
        @if ($articles->count())
            <section class="max-w-7xl mx-auto px-6 mb-20">

                <a href="{{ route('artikel.detail', $articles->first()['slug']) }}"
                    class="grid md:grid-cols-2 bg-white shadow-xl rounded-2xl overflow-hidden">

                    <img src="{{ $articles->first()['image'] ?? asset("/storage/".$articles->first()['image']) }}" class="h-full object-cover">

                    <div class="p-10">

                        <span class="text-red-600 text-sm font-semibold">
                            FEATURED ARTICLE
                        </span>

                        <h2 class="text-3xl font-bold mt-3">

                            {{ $articles->first()['title'] }}

                        </h2>

                        <p class="text-gray-600 mt-4">

                            {{ $articles->first()['excerpt'] }}

                        </p>

                        <p class="text-sm text-gray-400 mt-4">

                            ⏱ {{ ceil(str_word_count(strip_tags($articles->first()['content'])) / 200) }} min read

                        </p>

                    </div>

                </a>

            </section>
        @endif



        <section class="max-w-7xl mx-auto px-6 grid lg:grid-cols-4 gap-14">

            {{-- GRID ARTIKEL --}}
            <div class="lg:col-span-3 grid md:grid-cols-2 gap-10">

                <template
                    x-for="article in articles.filter(a =>
a.title.toLowerCase().includes(search.toLowerCase()) &&
(category=='all' || a.tags.includes(category))
)"
                    :key="article.slug">

                    <a :href="'/artikel/' + article.slug"
                        class="article-card bg-white rounded-xl shadow-lg overflow-hidden">

                        <img :src=" article.image ?? '/storage/' + article.image" class="w-full h-48 object-cover">

                        <div class="p-6">

                            <h3 class="font-bold text-xl mb-3" x-text="article.title">
                            </h3>

                            <p class="text-gray-600 text-sm mb-4" x-text="article.excerpt">
                            </p>

                            <div class="flex justify-between text-sm text-gray-400">

                                <span x-text="'⏱ '+Math.ceil(article.content.length/200)+' min read'">
                                </span>

                                <span x-text="'👁 '+article.views">
                                </span>

                            </div>

                        </div>

                    </a>

                </template>

            </div>



            {{-- SIDEBAR POPULER --}}
            <aside class="space-y-6">

                <h3 class="font-bold text-lg">
                    Artikel Populer
                </h3>

                @foreach ($articles->sortByDesc('views')->take(5) as $article)
                    <a href="{{ route('artikel.detail', $article['slug']) }}" class="flex gap-4 items-center">

                        <img src="{{ $articles->first()['image'] ?? asset("/storage/".$article['image']) }}" class="w-20 h-16 object-cover rounded">

                        <p class="text-sm font-semibold">

                            {{ $article['title'] }}

                        </p>

                    </a>
                @endforeach

            </aside>

        </section>



        {{-- PAGINATION --}}
        <div class="my-20 flex justify-center">

            {{ $articles->links() }}

        </div>

    </div>

</div>
