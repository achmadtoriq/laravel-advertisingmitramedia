<x-layout>
    <section class="relative py-24 bg-white overflow-hidden">

        <!-- Soft Background Glow -->
        <div class="absolute -top-32 -left-32 w-[400px] h-[400px] bg-red-500/10 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-orange-400/10 blur-[120px] rounded-full"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">

            <!-- Title -->
            <div class="text-center mb-16" data-aos="fade-up">

                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    Hubungi <span class="text-red-600">Mitramedia</span>
                </h2>

                <p class="text-gray-600 max-w-2xl mx-auto">
                    Konsultasikan kebutuhan neon box dan papan reklame Anda.
                    Tim kami siap membantu mulai dari desain hingga pemasangan profesional.
                </p>

            </div>


            <div class="grid lg:grid-cols-2 gap-14">

                <!-- CONTACT INFO -->
                <div class="space-y-8">

                    <!-- Phone Highlight -->
                    <div data-aos="fade-right"
                        class="bg-white border border-gray-100 p-8 rounded-2xl shadow-lg hover:shadow-xl transition">

                        <p class="text-gray-500 mb-2">
                            Konsultasi Langsung
                        </p>

                        <h3 class="text-4xl font-bold text-red-600 mb-6">
                            0817-784-867
                        </h3>

                        <a href="https://wa.me/62817784867"
                            class="relative inline-flex items-center gap-2 bg-green-500 text-white px-7 py-3 rounded-full font-semibold shadow hover:scale-105 transition">

                            <span
                                class="absolute animate-ping w-full h-full rounded-full bg-green-400 opacity-30"></span>

                            <i class="fa-brands fa-whatsapp relative"></i>
                            <span class="relative">Chat WhatsApp</span>

                        </a>

                    </div>


                    <!-- Contact Detail -->
                    <div data-aos="fade-right" data-aos-delay="200"
                        class="bg-white border border-gray-100 p-8 rounded-2xl shadow-lg space-y-4">

                        <div class="flex gap-4">
                            <i class="fa-solid fa-location-dot text-red-500 mt-1"></i>

                            <p class="text-gray-600">
                                Nginden Semolo 38-40, The Mezzanine A15
                                Sukolilo, Surabaya
                            </p>
                        </div>

                        <div class="flex gap-4">
                            <i class="fa-solid fa-phone text-red-500"></i>
                            <p class="text-gray-600">(031) 58253549</p>
                        </div>

                        <div class="flex gap-4">
                            <i class="fa-solid fa-envelope text-red-500"></i>
                            <p class="text-gray-600">adm.mitramedia@gmail.com</p>
                        </div>

                    </div>


                    <!-- Map -->
                    <div data-aos="fade-up" class="rounded-2xl overflow-hidden shadow-lg border border-gray-100">

                        <iframe
                            src="https://maps.google.com/maps?q=Nginden%20Semolo%20Surabaya&t=&z=15&ie=UTF8&iwloc=&output=embed"
                            class="w-full h-72 border-0 grayscale hover:grayscale-0 transition duration-500">
                        </iframe>

                    </div>

                </div>



                <!-- FORM -->
                <div data-aos="fade-left" class="bg-white border border-gray-100 p-10 rounded-2xl shadow-xl">

                    <h3 class="text-2xl font-semibold mb-6 text-gray-800">
                        Kirim Pesan
                    </h3>

                    <form class="space-y-6">

                        <div>
                            <label class="text-sm font-semibold text-gray-600">
                                Nama
                            </label>

                            <input type="text" placeholder="Masukkan nama Anda"
                                class="w-full mt-2 px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-red-500 outline-none">
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">
                                Email
                            </label>

                            <input type="email" placeholder="Masukkan email Anda"
                                class="w-full mt-2 px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-red-500 outline-none">
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">
                                Subject
                            </label>

                            <input type="text" placeholder="Apa yang ingin ditanyakan?"
                                class="w-full mt-2 px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-red-500 outline-none">
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">
                                Pesan
                            </label>

                            <textarea rows="4" placeholder="Ceritakan kebutuhan reklame Anda..."
                                class="w-full mt-2 px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-red-500 outline-none"></textarea>
                        </div>

                        <button
                            class="w-full bg-red-600 hover:bg-red-700 text-white py-3 rounded-lg font-semibold shadow-lg hover:scale-[1.02] transition">

                            Kirim Pesan
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </section>
</x-layout>
