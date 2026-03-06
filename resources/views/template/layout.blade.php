<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Title --}}
    <title>Jasa Neon Box Surabaya | Papan Reklame Murah</title>

    {{-- Meta Description --}}
    <meta name="description"
        content="Jasa pembuatan neon box dan papan reklame Surabaya dengan desain profesional, harga murah, dan pemasangan berkualitas.">

    {{-- Keywords --}}
    <meta name="keywords" content="jasa neon box, jasa pembuatan neon box, neon box murah, papan reklame surabaya">

    {{-- Author --}}
    <meta name="author" content="Mitra Media Advertising">

    {{-- Robots --}}
    <meta name="robots" content="index, follow">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="Jasa Neon Box Surabaya">
    <meta property="og:description" content="Jasa pembuatan neon box profesional di Surabaya">
    <meta property="og:image" content="{{ asset('img/og-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="{{ asset('img/og-image.jpg') }}">

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    {{-- Fonts / CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Preconnect untuk performa --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Structured Data SEO --}}
    @verbatim
        <script type="application/ld+json">
            {
            "@context": "https://schema.org",
            "@type": "LocalBusiness",
            "name": "Mitra Media Advertising",
            "description": "Jasa neon box dan papan reklame Surabaya",
            "areaServed": "Surabaya",
            "url": "https://domainanda.com",
            "image": "https://domainanda.com/img/og-image.jpg",
            "telephone": "+62xxxxxxxxxx"
            }
        </script>
    @endverbatim

    <!-- Google Tag Manager Penting Jangan sampai Hilang -->
    <script>
        // (function(w, d, s, l, i) {
        //     w[l] = w[l] || [];
        //     w[l].push({
        //         'gtm.start': new Date().getTime(),
        //         event: 'gtm.js'
        //     });
        //     var f = d.getElementsByTagName(s)[0],
        //         j = d.createElement(s),
        //         dl = l != 'dataLayer' ? '&l=' + l : '';
        //     j.async = true;
        //     j.src =
        //         'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        //     f.parentNode.insertBefore(j, f);
        // })(window, document, 'script', 'dataLayer', 'GTM-KF54DZ2G');
    </script>
    <!-- End Google Tag Manager -->

</head>

<body class="">

    <!-- Google Tag Manager (noscript) Penting Jangan sampai Hilang -->
    {{-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KF54DZ2G" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript> --}}
    <!-- End Google Tag Manager (noscript) -->

    <header x-data="{ scrolled: false, open: false }" @scroll.window="scrolled = window.scrollY > 10"
        :class="scrolled ? 'bg-white shadow-lg' : 'bg-white md:bg-transparent md:backdrop-blur-md'"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-300">

        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

            <img loading="lazy" decoding="async" class="h-10 transition-all duration-300" x-data="{ isMobile: window.innerWidth < 768 }"
                @resize.window="isMobile = window.innerWidth < 768"
                :src="isMobile
                    ?
                    '{{ asset('assets/images/mitramedia.webp') }}' :
                    (scrolled ?
                        '{{ asset('assets/images/mitramedia.webp') }}' :
                        '{{ asset('assets/images/mitramedia2.webp') }}')"
                alt="Jasa Neon Box Surabaya">

            <!-- Hamburger -->
            <button @click="open = !open" class="md:hidden text-2xl text-black">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex items-center gap-6 text-sm font-bold">

                <a href="/"
                    class="px-4 py-2 rounded-full hover:ring-2 hover:ring-red-600
        {{ request()->is('/') ? 'bg-red-600 text-white' : '' }}"
                    :class="scrolled ? 'text-black' : 'text-white'">
                    HOME
                </a>

                <a href="/about"
                    class="px-4 py-2 rounded-full hover:ring-2 hover:ring-red-600
        {{ request()->is('about') ? 'bg-red-600 text-white' : '' }}"
                    :class="scrolled ? 'text-black' : 'text-white'">
                    ABOUT
                </a>

                <a href="/project"
                    class="px-4 py-2 rounded-full hover:ring-2 hover:ring-red-600
        {{ request()->is('project') ? 'bg-red-600 text-white' : '' }}"
                    :class="scrolled ? 'text-black' : 'text-white'">
                    PROJECT
                </a>

                <a href="/contact"
                    class="px-4 py-2 rounded-full hover:ring-2 hover:ring-red-600
        {{ request()->is('contact') ? 'bg-red-600 text-white' : '' }}"
                    :class="scrolled ? 'text-black' : 'text-white'">
                    CONTACT
                </a>

                <a href="#" class="px-4 py-2 rounded-full bg-red-600 text-white">
                    HUBUNGI KAMI
                </a>

                <a href="#" class="flex items-center gap-1" :class="scrolled ? 'text-black' : 'text-white'">
                    <i class="fa-brands fa-instagram"></i> mitramedia.adv
                </a>

            </nav>

        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-transition class="md:hidden bg-white shadow-lg">

            <div class="flex flex-col p-6 gap-4 font-bold text-black">

                <a href="/">HOME</a>
                <a href="/about">ABOUT</a>
                <a href="/project">PROJECT</a>
                <a href="/contact">CONTACT</a>

                <a href="#" class="bg-red-600 text-white px-4 py-2 rounded-full text-center">
                    HUBUNGI KAMI
                </a>
                <a href="#" class="flex items-center gap-1 text-red-600 justify-center">
                    <i class="fa-brands fa-instagram"></i> mitramedia.adv
                </a>

            </div>

        </div>

    </header>


    {{ $slot }}

    <!-- Footer -->
    <footer class="bg-black text-white pt-10">

        <div class="max-w-7xl mx-auto px-6 pb-10">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 text-sm">

                <!-- Tagline -->
                <div class="space-y-4">
                    <h3 class="text-xl md:text-2xl font-extrabold">
                        Your Trust Ads Partner
                    </h3>
                </div>

                <!-- Produk -->
                <div class="space-y-4">
                    <h3 class="text-xl md:text-2xl font-extrabold">
                        Product & Layanan
                    </h3>

                    <ul class="space-y-2 text-gray-300">
                        <li>Letter Timbul</li>
                        <li>Neonbox & LedBox</li>
                        <li>Billboard & Baliho</li>
                        <li>X Banner</li>
                        <li>Brosur</li>
                        <li>Mobil Branding & Interior</li>
                    </ul>
                </div>

                <!-- Social -->
                <div class="space-y-4">
                    <h3 class="text-xl md:text-2xl font-extrabold">
                        Find Us On
                    </h3>

                    <div class="flex gap-4">
                        <a href="#">
                            <img class="w-8 hover:scale-110 transition" src="{{ asset('assets/square-facebook.svg') }}"
                                alt="">
                        </a>

                        <a href="#">
                            <img class="w-8 hover:scale-110 transition"
                                src="{{ asset('assets/square-x-twitter.svg') }}" alt="">
                        </a>

                        <a href="#">
                            <img class="w-8 hover:scale-110 transition" src="{{ asset('assets/instagram.svg') }}"
                                alt="">
                        </a>
                    </div>

                </div>

                <!-- Address -->
                <div class="space-y-4">
                    <h3 class="text-xl md:text-2xl font-extrabold">
                        Head Office
                    </h3>

                    <p class="text-gray-300 leading-relaxed">
                        Nginden Semolo 38-40, The Mezzanine A15 Kel. Nginden Jangkungan,
                        Kec. Sukolilo, Kota Surabaya Jawa Timur 60118
                    </p>

                    <div class="space-y-2 text-gray-300">

                        <p class="flex items-center gap-2">
                            <i class="fa-brands fa-whatsapp text-green-400"></i>
                            0822-1328-0698 (Telp / WA)
                        </p>

                        <p class="flex items-center gap-2">
                            <i class="fa-brands fa-whatsapp text-green-400"></i>
                            0817-784-867 (Telp / WA)
                        </p>

                        <p class="flex items-center gap-2">
                            <i class="fa-solid fa-phone"></i>
                            (031) 58253549
                        </p>

                        <p class="flex items-center gap-2">
                            <i class="fa-solid fa-envelope"></i>
                            adm.mitramedia@gmail.com
                        </p>

                    </div>
                </div>

            </div>
        </div>

        <!-- Copyright -->
        <div class="text-center text-sm border-t border-white/20 py-6 text-gray-400">
            Copyright © {{ date('Y') }} Mitramedia Advertising
        </div>

    </footer>

</body>

</html>
