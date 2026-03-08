<x-layout>
    <section class="relative py-24 bg-gradient-to-b from-white to-gray-50 overflow-hidden">

        <!-- Decorative Glow -->
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-red-500/20 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-orange-400/20 blur-[120px] rounded-full"></div>

        <div class="max-w-7xl mx-auto px-6">

            <!-- Title -->
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Tentang <span class="text-red-600">Mitramedia Advertising</span>
                </h2>

                <p class="text-gray-600 max-w-2xl mx-auto">
                    Spesialis jasa pembuatan neon box, papan reklame, dan media promosi outdoor di Surabaya
                    dengan desain modern, material berkualitas, dan pemasangan profesional.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-16 items-center">

                <!-- Image -->
                <div class="relative group">

                    <div
                        class="absolute inset-0 bg-gradient-to-r from-red-500 to-orange-400 rounded-2xl blur-xl opacity-40 group-hover:opacity-60 transition">
                    </div>

                    <img src="/assets/images/about-img.webp"
                        class="relative rounded-2xl shadow-2xl transform group-hover:scale-105 transition duration-500">

                    <!-- Floating Badge -->
                    <div
                        class="absolute -bottom-6 -right-6 bg-white shadow-xl rounded-xl px-6 py-3 text-sm font-semibold text-gray-700">
                        ⭐ 10+ Tahun Pengalaman
                    </div>

                </div>


                <!-- Content -->
                <div>

                    <h3 class="text-2xl font-semibold text-gray-900 mb-6">
                        Kenapa Memilih Mitramedia?
                    </h3>

                    <div class="grid sm:grid-cols-2 gap-6">

                        <!-- Item -->
                        <div class="group bg-white p-6 rounded-xl shadow hover:shadow-xl transition">
                            <div class="text-red-500 text-3xl mb-3">
                                <i class="fa-solid fa-lightbulb"></i>
                            </div>

                            <h4 class="font-semibold mb-2">
                                Desain Custom
                            </h4>

                            <p class="text-gray-600 text-sm">
                                Desain neon box dan reklame dibuat sesuai kebutuhan brand bisnis Anda.
                            </p>
                        </div>

                        <!-- Item -->
                        <div class="group bg-white p-6 rounded-xl shadow hover:shadow-xl transition">
                            <div class="text-red-500 text-3xl mb-3">
                                <i class="fa-solid fa-star"></i>
                            </div>

                            <h4 class="font-semibold mb-2">
                                Material Berkualitas
                            </h4>

                            <p class="text-gray-600 text-sm">
                                Menggunakan bahan premium agar reklame tahan lama dan tetap terlihat menarik.
                            </p>
                        </div>

                        <!-- Item -->
                        <div class="group bg-white p-6 rounded-xl shadow hover:shadow-xl transition">
                            <div class="text-red-500 text-3xl mb-3">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>

                            <h4 class="font-semibold mb-2">
                                Lokasi Strategis
                            </h4>

                            <p class="text-gray-600 text-sm">
                                Penempatan media promosi di lokasi yang memiliki visibilitas tinggi.
                            </p>
                        </div>

                        <!-- Item -->
                        <div class="group bg-white p-6 rounded-xl shadow hover:shadow-xl transition">
                            <div class="text-red-500 text-3xl mb-3">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                            </div>

                            <h4 class="font-semibold mb-2">
                                Pemasangan Profesional
                            </h4>

                            <p class="text-gray-600 text-sm">
                                Tim teknisi berpengalaman memastikan pemasangan aman dan presisi.
                            </p>
                        </div>

                    </div>

                    <!-- CTA -->
                    <div class="mt-10 flex flex-wrap gap-4">

                        <a href="#kontak"
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold shadow-lg transition">
                            Konsultasi Gratis
                        </a>

                        <a href="#portfolio"
                            class="border border-gray-300 hover:border-red-500 px-6 py-3 rounded-lg font-semibold transition">
                            Lihat Portfolio
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <x-butuh></x-butuh>

</x-layout>
