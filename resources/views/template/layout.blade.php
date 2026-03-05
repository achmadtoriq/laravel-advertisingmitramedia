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

</head>

<body class="bg-white text-gray-800">

    {{ $slot }}

</body>

</html>
