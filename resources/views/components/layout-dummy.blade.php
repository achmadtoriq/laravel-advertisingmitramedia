<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Landing Page' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-800">

    <!-- Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="bg-black">
        <div class="container mx-auto py-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                <div>
                    <h3>Product & Layanan</h3>
                </div>
                <div>
                    <h3>Product & Layanan</h3>
                </div>
                <div>
                    <h3>Product & Layanan</h3>
                </div>
                <div>
                    <h3>Product & Layanan</h3>
                </div>
            </div>
        </div>
        <div class="text-center text-xs border-t border-white">
            <p>Copyright © {{ date('Y') }} Mitramedia Advertising</p>
        </div>
    </footer>

</body>

</html>
