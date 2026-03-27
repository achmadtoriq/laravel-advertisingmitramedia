<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-50 relative overflow-hidden">


    <!-- subtle glow -->
    <div class="absolute -top-40 -left-40 w-[500px] h-[500px] bg-red-500/10 blur-[120px] rounded-full"></div>

    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-orange-400/10 blur-[120px] rounded-full"></div>


    <div class="relative w-full px-6">

        {{ $slot }}

    </div>

</body>

</html>
