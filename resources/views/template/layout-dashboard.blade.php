<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('cropper')

</head>

<body class="bg-gray-100">

    <div x-data="{ open: true }" class="flex h-screen overflow-hidden">

        <!-- SIDEBAR -->
        <aside :class="open ? 'w-60' : 'w-16'" class="transition-all duration-300 bg-white shadow-xl flex flex-col">

            <!-- LOGO -->
            <div class="h-16 flex items-center justify-center">

                <span x-show="open" class="font-bold text-lg tracking-wide">
                    CMS
                </span>

                <i x-show="!open" class="fa-solid fa-cube text-gray-600"></i>

            </div>


            <!-- TOGGLE BUTTON -->
            <div class="p-3">

                <button @click="open = !open" :class="open ? 'text-right' : 'text-center'"
                    class="w-full text-gray-500 hover:text-black transition-all duration-300 cursor-pointer">

                    <i x-show="open" class="fa-solid fa-angles-left"></i>

                    <i x-show="!open" class="fa-solid fa-angles-right"></i>

                </button>

            </div>


            <!-- MENU -->
            <x-sidemenu></x-sidemenu>


        </aside>



        <!-- MAIN AREA -->
        <div class="flex-1 flex flex-col">

            <!-- TOPBAR -->
            <header class="h-16 bg-white shadow flex items-center justify-between px-6">

                <h1 class="font-semibold text-gray-700">
                    Admin Dashboard
                </h1>

                <form method="POST" action="/logout">
                    @csrf
                    <button class="text-red-500 text-sm hover:underline cursor-pointer">
                        <i class="fa-solid fa-power-off"></i>
                    </button>
                </form>

            </header>


            <!-- CONTENT -->
            <main class="flex-1 overflow-y-auto p-6">
                <x-breadcrumb></x-breadcrumb>

                <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-6">

                    {{ $slot }}

                </div>

            </main>

        </div>


    </div>

</body>

</html>
