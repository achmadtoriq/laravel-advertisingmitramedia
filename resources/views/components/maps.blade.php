<section class="py-16 md:py-24 bg-gray-100 overflow-hidden">

    <div class="max-w-7xl mx-auto px-6">

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">

            <div class="grid lg:grid-cols-2 items-center">

                <!-- LEFT -->
                <div class="p-8 md:p-12 lg:p-16">

                    <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold leading-tight">

                        Project Kami<br>

                        <span class="text-red-600">
                            Tersebar di Seluruh Indonesia
                        </span>

                    </h2>

                    <p class="mt-4 text-gray-600 max-w-md text-sm md:text-base">

                        Mitramedia Advertising telah mengerjakan berbagai project neon box,
                        billboard, dan media di berbagai kota besar di Indonesia.

                    </p>

                    <!-- STATS -->
                    <div class="grid grid-cols-3 gap-3 md:gap-5 mt-8 max-w-md">

                        <!-- PROJECT -->
                        <div class="bg-gray-50 rounded-xl px-4 py-4 shadow text-center hover:scale-105 transition"
                            x-data="{ count: 0 }" x-init="let i = setInterval(() => { count++; if (count >= 100) clearInterval(i) }, 15)">

                            <p class="text-xl md:text-3xl font-bold text-red-600">
                                <span x-text="count"></span>+
                            </p>

                            <p class="text-gray-500 text-xs md:text-sm">
                                Project
                            </p>

                        </div>


                        <!-- KOTA -->
                        <div class="bg-gray-50 rounded-xl px-4 py-4 shadow text-center hover:scale-105 transition"
                            x-data="{ count: 0 }" x-init="let i = setInterval(() => { count++; if (count >= 12) clearInterval(i) }, 80)">

                            <p class="text-xl md:text-3xl font-bold text-red-600">
                                <span x-text="count"></span>+
                            </p>

                            <p class="text-gray-500 text-xs md:text-sm">
                                Kota
                            </p>

                        </div>


                        <!-- KLIEN -->
                        <div class="bg-gray-50 rounded-xl px-4 py-4 shadow text-center hover:scale-105 transition"
                            x-data="{ count: 0 }" x-init="let i = setInterval(() => { count++; if (count >= 50) clearInterval(i) }, 30)">

                            <p class="text-xl md:text-3xl font-bold text-red-600">
                                <span x-text="count"></span>+
                            </p>

                            <p class="text-gray-500 text-xs md:text-sm">
                                Klien
                            </p>

                        </div>

                    </div>

                </div>


                <!-- MAP -->
                <div class="relative flex items-center justify-center p-6 md:p-10">

                    <img src="/assets/images/map_indonesia.png" class="w-full max-w-md md:max-w-xl rounded-2xl"
                        alt="Map Indonesia">


                    <!-- JAKARTA -->
                    <div class="absolute top-[57%] left-[28%]">

                        <!-- ping glow -->
                        <span
                            class="absolute -top-1 -left-1 w-5 h-5 bg-red-500 rounded-full opacity-40 animate-ping"></span>

                        <!-- pin -->
                        <i class="fa-solid fa-location-dot text-red-600 text-lg"></i>

                    </div>


                    <!-- SURABAYA -->
                    <div class="absolute top-[60%] left-[38%] group">

                        <!-- ping glow -->
                        <span
                            class="absolute -top-1 -left-1 w-5 h-5 bg-red-500 rounded-full opacity-40 animate-ping"></span>

                        <!-- pin -->
                        <i class="fa-solid fa-location-dot text-red-600 text-lg"></i>

                    </div>


                    <!-- MAKASSAR -->
                    <div class="absolute top-[56%] left-[56%] group">

                        <span
                            class="absolute -top-1 -left-1 w-5 h-5 bg-red-500 rounded-full opacity-40 animate-ping"></span>

                        <i class="fa-solid fa-location-dot text-red-600 text-lg"></i>

                    </div>


                    <!-- PAPUA -->
                    <div class="absolute top-[53%] left-[83%] group">

                        <span
                            class="absolute -top-1 -left-1 w-5 h-5 bg-red-500 rounded-full opacity-40 animate-ping"></span>

                        <i class="fa-solid fa-location-dot text-red-600 text-lg"></i>

                    </div>
                </div>

            </div>

        </div>

    </div>

</section>
