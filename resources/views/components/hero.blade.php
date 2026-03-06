<section class="relative min-h-screen flex items-center overflow-hidden" x-data="{ y: 0 }"
    @scroll.window="y = window.scrollY">

    <!-- PARALLAX BACKGROUND -->
    <div class="absolute inset-0 overflow-hidden">

        <img src="{{ asset('assets/images/bg_reklame_siang.png') }}" class="w-full h-full object-cover scale-110"
            :style="'transform: translateY(' + (y * 0.25) + 'px) scale(1.1)'" alt="Jasa Neon Box Surabaya">

    </div>

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-black/70 md:bg-gradient-to-r md:from-black/80 md:via-black/60 md:to-black/20"></div>


    <!-- CONTENT -->
    <div class="relative max-w-7xl mx-auto px-6 py-28 md:py-24 grid lg:grid-cols-2 gap-14 items-center">


        <!-- LEFT CONTENT -->
        <div class="text-white max-w-xl" x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)">

            <!-- BADGE -->
            <span x-show="show" x-transition
                class="inline-flex items-center gap-2 bg-red-600/20 text-red-400 px-4 py-1 rounded-full text-xs md:text-sm font-semibold">

                ⭐ Advertising & Branding Specialist

            </span>


            <!-- HEADLINE -->
            <h1 x-show="show" x-transition
                class="mt-6 text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight">

                Mitramedia Advertising

                <span class="block text-red-500">
                    Jasa Neon Box & Reklame Surabaya
                </span>

            </h1>


            <!-- DESCRIPTION -->
            <p x-show="show" x-transition class="mt-6 text-sm sm:text-base md:text-lg text-gray-200 leading-relaxed">

                Tingkatkan visibilitas bisnis Anda dengan media reklame profesional.
                Mitramedia Advertising menyediakan layanan desain, produksi hingga
                pemasangan neon box dan billboard berkualitas di Surabaya.

            </p>


            <!-- CTA -->
            <div x-show="show" x-transition class="mt-8 flex flex-col sm:flex-row gap-4">

                <a href="#kontak"
                    class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-lg font-semibold shadow-lg text-center w-full sm:w-auto transition">

                    Konsultasi Gratis

                </a>

                <a href="#portfolio"
                    class="bg-white/10 backdrop-blur-md border border-white/30 px-6 py-3 rounded-lg hover:bg-white hover:text-black text-center w-full sm:w-auto transition">

                    Lihat Portfolio

                </a>

            </div>


            <!-- TRUST METRICS -->
            <div class="mt-12 grid grid-cols-3 gap-3 md:gap-6 max-w-md">

                <!-- PROJECT -->
                <div class="group relative bg-white/5 backdrop-blur-md border border-white/10 rounded-xl p-3 md:p-4 text-center hover:border-red-500/40 transition"
                    x-data="{ count: 0 }" x-init="let i = setInterval(() => { count++; if (count >= 100) clearInterval(i) }, 15)">

                    <div class="absolute inset-0 bg-red-500/0 group-hover:bg-red-500/10 blur-xl transition"></div>

                    <p class="relative text-xl md:text-3xl font-bold text-red-500">
                        <span x-text="count"></span>+
                    </p>

                    <p class="relative text-gray-300 text-xs md:text-sm">
                        Project
                    </p>

                </div>


                <!-- EXPERIENCE -->
                <div class="group relative bg-white/5 backdrop-blur-md border border-white/10 rounded-xl p-3 md:p-4 text-center hover:border-red-500/40 transition"
                    x-data="{ count: 0 }" x-init="let i = setInterval(() => { count++; if (count >= 10) clearInterval(i) }, 60)">

                    <div class="absolute inset-0 bg-red-500/0 group-hover:bg-red-500/10 blur-xl transition"></div>

                    <p class="relative text-xl md:text-3xl font-bold text-red-500">
                        <span x-text="count"></span>+
                    </p>

                    <p class="relative text-gray-300 text-xs md:text-sm">
                        Tahun
                    </p>

                </div>


                <!-- CLIENT -->
                <div class="group relative bg-white/5 backdrop-blur-md border border-white/10 rounded-xl p-3 md:p-4 text-center hover:border-red-500/40 transition"
                    x-data="{ count: 0 }" x-init="let i = setInterval(() => { count++; if (count >= 50) clearInterval(i) }, 25)">

                    <div class="absolute inset-0 bg-red-500/0 group-hover:bg-red-500/10 blur-xl transition"></div>

                    <p class="relative text-xl md:text-3xl font-bold text-red-500">
                        <span x-text="count"></span>+
                    </p>

                    <p class="relative text-gray-300 text-xs md:text-sm">
                        Klien
                    </p>

                </div>

            </div>

        </div>


        <!-- RIGHT VISUAL -->
        <div class="hidden lg:flex justify-center">

            <div class="relative max-w-md">

                <!-- Glow -->
                <div class="absolute inset-0 bg-red-500/20 blur-3xl rounded-full"></div>

                <!-- Glass Card -->
                <div class="relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 shadow-2xl">

                    <div class="overflow-hidden rounded-xl" x-data="{
                        current: 0,
                        images: [
                            '{{ asset('assets/images/billboard_mockup.png') }}',
                            '{{ asset('assets/images/bg_reklame_siang.png') }}',
                            '{{ asset('assets/images/billboard_mockup.png') }}'
                        ]
                    }" x-init="setInterval(() => current = (current + 1) % images.length, 4000)">

                        <div class="flex transition-transform duration-700"
                            :style="'transform: translateX(-' + current * 100 + '%)'">

                            <template x-for="img in images">
                                <img :src="img" class="w-full flex-shrink-0" alt="Project Neon Box">
                            </template>

                        </div>

                    </div>

                    <div class="mt-4 text-center text-gray-200 text-sm">
                        Project Billboard & Neon Box
                    </div>

                </div>

            </div>

        </div>


    </div>

</section>
