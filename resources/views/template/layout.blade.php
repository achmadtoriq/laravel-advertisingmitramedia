<html>

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Title --}}
    <title>{{ $title ?? 'Jasa Neon Box Surabaya | Mitramedia Advertising' }}</title>

    {{-- Meta Description --}}
    <meta name="description" content="{{ $description ?? 'Jasa neon box Surabaya profesional.' }}">

    {{-- Keywords --}}
    <meta name="keywords"
        content="{{ $keyword ?? 'jasa neon box, jasa pembuatan neon box, neon box murah, papan reklame surabaya' }}">

    {{-- Author --}}
    <meta name="author" content="Mitra Media Advertising">

    {{-- Robots --}}
    <meta name="robots" content="index, follow">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Open Graph --}}
    {{ $OgMeta ?? '' }}

    {{-- Twitter Card --}}
    {{ $TwitterMeta ?? '' }}

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
            "url": "https://advertisingmitramedia.com/",
            "image": "https://advertisingmitramedia.com/assets/images/about-img.webp",
            "telephone": "+6282213280698"
            }
        </script>
    @endverbatim

    <!-- Fancybox -->
    <link href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css" rel="stylesheet">


    <!-- Google Tag Manager Penting Jangan sampai Hilang -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-KF54DZ2G');
    </script>
    <!-- End Google Tag Manager -->

</head>

<body class="">

    <!-- Google Tag Manager (noscript) Penting Jangan sampai Hilang -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KF54DZ2G" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    @php
        $isHome = request()->is('/');
        $isSpecialPage = request()->is('/') || request()->is('artikel');
    @endphp

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
                        '{{ $isSpecialPage ? asset('assets/images/mitramedia2.webp') : asset('assets/images/mitramedia.webp') }}'
                    )"
                alt="Jasa Neon Box Surabaya">

            {{-- <img loading="lazy" decoding="async" class="h-10 transition-all duration-300" x-data="{ isMobile: window.innerWidth < 768 }"
                @resize.window="isMobile = window.innerWidth < 768"
                :src="isMobile
                    ?
                    '{{ asset('assets/images/mitramedia.webp') }}' :
                    (scrolled || !{{ $isHome ? 'true' : 'false' }} ?
                        '{{ asset('assets/images/mitramedia.webp') }}' :
                        '{{ asset('assets/images/mitramedia2.webp') }}')"
                alt="Jasa Neon Box Surabaya"> --}}

            <!-- Hamburger -->
            <button @click="open = !open" class="md:hidden text-2xl text-black">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex items-center gap-6 text-sm font-bold">

                <a href="{{ url('/') }}"
                    class="px-4 py-2 rounded-full hover:ring-2 hover:ring-red-600
        {{ request()->is('/') ? 'bg-red-600 text-white' : '' }}"
                    :class="scrolled || !{{ $isHome ? 'true' : 'false' }} ? 'text-black' : 'text-white'">
                    HOME
                </a>

                <a href="{{ url('about-us') }}"
                    class="px-4 py-2 rounded-full hover:ring-2 hover:ring-red-600
        {{ request()->is('about-us') ? 'bg-red-600 text-white' : '' }}"
                    :class="scrolled || !{{ $isHome ? 'true' : 'false' }} ? 'text-black' : 'text-white'">
                    ABOUT
                </a>

                <a href="{{ url('artikel') }}"
                    class="px-4 py-2 rounded-full hover:ring-2 hover:ring-red-600
        {{ request()->is('artikel') ? 'bg-red-600 text-white' : '' }}"
                    :class="scrolled || !{{ $isHome ? 'true' : 'false' }} ? 'text-black' : 'text-white'">
                    ARTIKEL
                </a>

                <a href="{{ url('project') }}"
                    class="px-4 py-2 rounded-full hover:ring-2 hover:ring-red-600
        {{ request()->is('project') ? 'bg-red-600 text-white' : '' }}"
                    :class="scrolled || !{{ $isHome ? 'true' : 'false' }} ? 'text-black' : 'text-white'">
                    PROJECT
                </a>

                <a href="{{ url('contact-us') }}"
                    class="px-4 py-2 rounded-full hover:ring-2 hover:ring-red-600
        {{ request()->is('contact-us') ? 'bg-red-600 text-white' : '' }}"
                    :class="scrolled || !{{ $isHome ? 'true' : 'false' }} ? 'text-black' : 'text-white'">
                    CONTACT
                </a>

                <a href="https://api.whatsapp.com/send?phone=6282213280698&amp;text=Halo%2C%20saya%20tertarik%20dengan%20penawaran%20di%20website%20Anda.%20Bisa%20berikan%20detail%20lebih%20lanjut%3F"
                    target="_blank" class="px-4 py-2 rounded-full bg-red-600 text-white">
                    HUBUNGI KAMI
                </a>

                <a href="https://www.instagram.com/mitramedia.adv" target="_blank" class="flex items-center gap-1"
                    :class="scrolled || !{{ $isHome ? 'true' : 'false' }} ? 'text-black' : 'text-white'">
                    <i class="fa-brands fa-instagram"></i> mitramedia.adv
                </a>

            </nav>

        </div>

        <!-- Mobile Menu -->
        <!-- Mobile Menu -->
        <div x-show="open" x-transition class="md:hidden bg-white shadow-lg">

            <div class="flex flex-col p-6 gap-4 font-bold text-black">

                <a href="{{ url('/') }}"
                    class="px-4 py-2 rounded-lg
            {{ request()->is('/') ? 'bg-red-600 text-white' : '' }}">
                        HOME
                    </a>

                    <a href="{{ url('about-us') }}"
                        class="px-4 py-2 rounded-lg
            {{ request()->is('about-us') ? 'bg-red-600 text-white' : '' }}">
                        ABOUT
                    </a>

                    <a href="{{ url('artikel') }}"
                        class="px-4 py-2 rounded-lg
            {{ request()->is('artikel') ? 'bg-red-600 text-white' : '' }}">
                        ARTIKEL
                    </a>

                    <a href="{{ url('project') }}"
                        class="px-4 py-2 rounded-lg
            {{ request()->is('project') ? 'bg-red-600 text-white' : '' }}">
                        PROJECT
                    </a>

                    <a href="{{ url('contact-us') }}"
                        class="px-4 py-2 rounded-lg
            {{ request()->is('contact-us') ? 'bg-red-600 text-white' : '' }}">
                    CONTACT
                </a>

                <a href="https://api.whatsapp.com/send?phone=6282213280698&amp;text=Halo%2C%20saya%20tertarik%20dengan%20penawaran%20di%20website%20Anda.%20Bisa%20berikan%20detail%20lebih%20lanjut%3F"
                    target="_blank" class="bg-red-600 text-white px-4 py-2 rounded-full text-center">
                    HUBUNGI KAMI
                </a>

                <a href="https://www.instagram.com/mitramedia.adv" target="_blank"
                    class="flex items-center gap-1 text-red-600 justify-center">
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
                <div class="flex flex-col items-center space-y-4">

                    <img loading="lazy" decoding="async" class="h-10 transition-all duration-300"
                        src="{{ asset('assets/images/mitramedia2.webp') }}" alt="Jasa Neon Box Surabaya">

                    <h3 class="text-lg md:text-xl font-semibold text-gray-300 text-center md:text-left">
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

    <div class="fixed bottom-6 right-6 z-[9999] group">

        <!-- Tooltip -->
        <div
            class="absolute bottom-20 right-0 bg-white shadow-xl rounded-xl px-4 py-2 text-sm text-gray-700 border 
        opacity-0 translate-y-2 pointer-events-none
        group-hover:opacity-100 group-hover:translate-y-0
        transition duration-300 whitespace-nowrap">

            Butuh bantuan? 💬

        </div>

        <!-- Button -->
        <a href="https://api.whatsapp.com/send?phone=6282213280698&amp;text=Halo%2C%20saya%20tertarik%20dengan%20penawaran%20di%20website%20Anda.%20Bisa%20berikan%20detail%20lebih%20lanjut%3F"
            target="_blank"
            class="relative flex items-center justify-center w-16 h-16 rounded-full bg-green-500 text-white shadow-2xl hover:scale-110 transition">

            <span class="absolute w-full h-full rounded-full bg-green-400 opacity-30 animate-ping"></span>

            <i class="fa-brands fa-whatsapp text-3xl relative"></i>

        </a>

    </div>

    <x-visitor></x-visitor>

    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
</body>

</html>
