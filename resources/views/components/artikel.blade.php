<div x-data="{
    search: '',
    category: 'all',
    articles: @js($articles->items()),
    filteredArticles() {
        const term = this.search.toLowerCase().trim();

        return this.articles.filter(article => {
            const title = (article.title || '').toLowerCase();
            const excerpt = (article.excerpt || '').toLowerCase();
            const tags = article.tag_keys || [];

            return (term === '' || title.includes(term) || excerpt.includes(term)) &&
                (this.category === 'all' || tags.includes(this.category));
        });
    }
}">

    {{-- SEARCH + FILTER --}}
    <section class="max-w-7xl mx-auto px-6 py-12">

        <div class="flex flex-col gap-5 md:flex-row md:items-center md:justify-between">

            <div class="relative w-full md:max-w-md">
                <!-- Icon Search -->
                <i class="fa-solid fa-magnifying-glass
                          absolute left-4 top-1/2 -translate-y-1/2
                          text-gray-400 text-base
                          pointer-events-none"></i>
            
                <!-- Input -->
                <input
                    type="text"
                    placeholder="Cari artikel..."
                    x-model="search"
                    class="w-full h-14
                           rounded-lg
                           border border-gray-200
                           bg-gray-50
                           pl-12 pr-4
                           text-sm leading-none text-gray-700
                           placeholder:text-gray-400
                           shadow-inner
                           transition-all duration-200
                           focus:bg-white
                           focus:border-red-500
                           focus:ring-2
                           focus:ring-red-500/20
                           focus:outline-none"
                >
            </div>

            <div class="flex min-w-0 flex-1 items-center md:justify-end">

                <div class="flex max-w-full flex-wrap gap-1.5 md:justify-end md:gap-2">

                    <button @click="category='all'"
                        :class="category === 'all'
                            ?
                            'bg-red-600 text-white shadow-sm' :
                            'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                        class="h-8 rounded-lg px-3 text-xs font-semibold transition cursor-pointer sm:h-9 sm:text-sm md:h-10 md:px-4">

                        Semua

                    </button>

                    @foreach ($tagFilters as $tag)
                        <button @click="category=@js(str($tag)->lower()->value())"
                            :class="category === @js(str($tag)->lower()->value())
                            ?
                            'bg-red-600 text-white shadow-sm' :
                            'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                            class="h-8 rounded-lg px-3 text-xs font-semibold transition cursor-pointer sm:h-9 sm:text-sm md:h-10 md:px-4">

                            {{ $tag }}

                        </button>
                    @endforeach

                </div>

            </div>

        </div>

    </section>



    <div id="article-container">

        {{-- FEATURED HERO --}}
        @if ($articles->count())
            <section class="max-w-7xl mx-auto px-6 mb-20">

                <a href="{{ url('/artikel/' . $articles->first()['slug']) }}"
                    class="grid md:grid-cols-2 bg-white shadow-xl rounded-2xl overflow-hidden">

                    <img src="{{ $articles->first()['image'] }}" class="h-full min-h-72 object-cover"
                        alt="{{ $articles->first()['title'] }}">

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

                            ⏱ {{ $articles->first()['reading_time'] }} min read

                        </p>

                    </div>

                </a>

            </section>
        @endif



        <section class="max-w-7xl mx-auto px-6 grid lg:grid-cols-4 gap-14">

            {{-- GRID ARTIKEL --}}
            <div class="lg:col-span-3 grid md:grid-cols-2 gap-10">

                <template
                    x-for="article in filteredArticles()"
                    :key="article.slug">

                    <a :href="'/artikel/' + article.slug"
                        class="article-card bg-white rounded-xl shadow-lg overflow-hidden">

                        <img :src="article.image" class="w-full h-48 object-cover" :alt="article.title">

                        <div class="p-6">

                            <h3 class="font-bold text-xl mb-3" x-text="article.title">
                            </h3>

                            <p class="text-gray-600 text-sm mb-4" x-text="article.excerpt">
                            </p>

                            <div class="flex justify-between text-sm text-gray-400">

                                <span x-text="'⏱ ' + article.reading_time + ' min read'">
                                </span>

                                <span x-text="'👁 '+article.views">
                                </span>

                            </div>

                        </div>

                    </a>

                </template>

                <div x-show="filteredArticles().length === 0" class="md:col-span-2 rounded-xl border border-gray-200 bg-white p-10 text-center text-gray-500">
                    Artikel tidak ditemukan.
                </div>

            </div>



            {{-- SIDEBAR POPULER --}}
            <aside class="space-y-6">

                <h3 class="font-bold text-lg">
                    Artikel Populer
                </h3>

                @foreach ($popularArticles as $article)
                    <a href="{{ url('/artikel/' . $article['slug']) }}" class="flex gap-4 items-center">

                        <img src="{{ $article['image'] }}" class="w-20 h-16 object-cover rounded"
                            alt="{{ $article['title'] }}">

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
