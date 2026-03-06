<section class="relative min-h-screen flex items-center overflow-hidden" x-data="{ y: 0 }"
    @scroll.window="y = window.scrollY">

    <!-- PARALLAX BACKGROUND -->
    <div class="absolute inset-0 overflow-hidden">

        <img src="{{ asset('assets/images/bg_reklame_siang.png') }}" class="w-full h-full object-cover"
            :style="'transform: translateY(' + (y * 0.3) + 'px) scale(1.1)'" alt="Jasa Neon Box Surabaya">

    </div>

    <!-- OVERLAY -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/20"></div>


    <!-- CONTENT -->
    <div class="relative max-w-7xl mx-auto px-6 py-20 lg:py-24 grid lg:grid-cols-2 gap-14 items-center">


        <!-- LEFT CONTENT -->
        <div class="text-white" x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)">


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
            <p x-show="show" x-transition
                class="mt-6 text-sm sm:text-base md:text-lg text-gray-200 max-w-xl leading-relaxed">

                Tingkatkan visibilitas bisnis Anda dengan media reklame profesional.
                Mitramedia Advertising menyediakan layanan desain, produksi hingga
                pemasangan neon box dan billboard berkualitas di Surabaya.

            </p>


            <!-- CTA -->
            <div x-show="show" x-transition class="mt-8 flex flex-col sm:flex-row gap-4">

                <a href="#kontak"
                    class="bg-red-600 hover:bg-red-700 px-6 py-3 rounded-lg font-semibold text-center transition">
                    Konsultasi Gratis
                </a>

                <a href="#portfolio"
                    class="bg-white/10 backdrop-blur-md border border-white/30 px-6 py-3 rounded-lg hover:bg-white hover:text-black text-center transition">
                    Lihat Portfolio
                </a>

            </div>


            <!-- TRUST METRICS -->
            <div class="mt-12 grid grid-cols-3 sm:grid-cols-3 gap-4 max-w-md">

                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-xl p-4 text-center">

                    <p class="text-2xl md:text-3xl font-bold text-red-500">100+</p>
                    <p class="text-gray-300 text-xs md:text-sm">Project</p>

                </div>

                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-xl p-4 text-center">

                    <p class="text-2xl md:text-3xl font-bold text-red-500">10+</p>
                    <p class="text-gray-300 text-xs md:text-sm">Tahun</p>

                </div>

                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-xl p-4 text-center">

                    <p class="text-2xl md:text-3xl font-bold text-red-500">50+</p>
                    <p class="text-gray-300 text-xs md:text-sm">Klien</p>

                </div>

            </div>

        </div>


        <!-- RIGHT SIDE VISUAL -->
        <div class="hidden lg:flex justify-center">

            <div class="relative max-w-md">

                <div class="absolute inset-0 bg-red-500/20 blur-3xl rounded-full"></div>

                <div class="relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-2xl p-6 shadow-2xl">

                    <img src="{{ asset('assets/images/billboard_mockup.png') }}" class="rounded-xl w-full"
                        alt="Project Neon Box">

                    <div class="mt-4 text-center text-gray-200 text-sm">
                        Project Billboard & Neon Box
                    </div>

                </div>

            </div>

        </div>


    </div>

</section>
