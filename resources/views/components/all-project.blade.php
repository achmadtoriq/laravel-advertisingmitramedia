<section class="pb-28 bg-gray-50">

    <div class="max-w-7xl mx-auto px-6">

        <div id="portfolio-grid" class="columns-2 md:columns-3 lg:columns-4 gap-6 space-y-6">

            @foreach ($projects as $project)
                <div class="portfolio-item {{ $project['category'] }} break-inside-avoid" data-aos="fade-up">

                    <a href="{{ asset($project['image']) }}" data-fancybox="gallery">

                        <div
                            class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition duration-500">

                            <img src="{{ asset($project['image']) }}"
                                class="w-full object-cover group-hover:scale-110 transition duration-700">

                            <div
                                class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">

                                <div class="text-white text-center px-4">

                                    <h3 class="text-lg font-semibold">
                                        {{ $project['title'] }}
                                    </h3>

                                    <p class="text-sm opacity-80">
                                        {{ $project['location'] }}
                                    </p>

                                </div>

                            </div>

                        </div>

                    </a>

                </div>
            @endforeach

        </div>

    </div>

</section>

<script>
    const buttons = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.portfolio-item');

    buttons.forEach(btn => {

        btn.addEventListener('click', () => {

            buttons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            let filter = btn.dataset.filter;

            items.forEach(item => {

                if (filter === 'all') {
                    item.style.display = 'block';
                } else {

                    if (item.classList.contains(filter)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }

                }

            });

        });

    });
</script>
