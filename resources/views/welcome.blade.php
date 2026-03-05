<x-layout-dummy title="Modern Landing Page">

    <!-- HERO -->
    <section class="relative h-screen bg-cover bg-center bg-fixed flex items-center"
        style="background-image: url('/assets/images/bg-reklame.png')">

        <!-- Overlay Gelap -->
        <div class="absolute inset-0 bg-black/60"></div>

        <div class="relative max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">

            <div>

                <h1 data-aos="fade-right" data-aos-duration="1000"
                    class="text-4xl md:text-6xl font-bold leading-tight text-white">
                    Jasa Neonbox & Papan Reklame Profesional
                </h1>

                <p data-aos="fade-right" data-aos-delay="200" data-aos-duration="1000"
                    class="mt-6 text-lg text-gray-200">
                    Solusi branding visual terbaik untuk bisnis Anda di Surabaya.
                </p>

                <div data-aos="fade-up" data-aos-delay="400" class="mt-8 flex gap-4">

                    <a href="#kontak"
                        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 hover:scale-105">
                        Konsultasi Gratis
                    </a>

                    <a href="#portfolio"
                        class="border border-white text-white px-6 py-3 rounded-lg hover:bg-white hover:text-red-700 transition duration-300">
                        Lihat Portfolio
                    </a>

                </div>

            </div>

        </div>
    </section>

    <!-- ABOUT -->
    <section id="about" class="py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-6" data-aos="fade-up">
                About Me
            </h2>
            <p class="max-w-2xl mx-auto text-gray-600" data-aos="fade-up" data-aos-delay="200">
                Experienced in Laravel, REST API, Payment Gateway, and scalable backend system architecture.
            </p>
        </div>
    </section>

    <!-- SERVICES -->
    <section id="services" class="py-20 bg-gray-100">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-12" data-aos="fade-up">
                My Services
            </h2>

            <div class="grid md:grid-cols-3 gap-8">

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:-translate-y-2 transition duration-300"
                    data-aos="zoom-in">
                    <h3 class="text-xl font-semibold mb-4">Web Development</h3>
                    <p>Modern Laravel application.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:-translate-y-2 transition duration-300"
                    data-aos="zoom-in" data-aos-delay="200">
                    <h3 class="text-xl font-semibold mb-4">API Specialist</h3>
                    <p>RESTful & third-party integrations.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg hover:-translate-y-2 transition duration-300"
                    data-aos="zoom-in" data-aos-delay="400">
                    <h3 class="text-xl font-semibold mb-4">System Architecture</h3>
                    <p>Scalable & secure backend system.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-6" data-aos="fade-up">
                Let's Work Together
            </h2>
            <a href="mailto:youremail@email.com"
                class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-semibold hover:scale-105 transition duration-300"
                data-aos="fade-up" data-aos-delay="200">
                Contact Me
            </a>
        </div>
    </section>

</x-layout-dummy>
