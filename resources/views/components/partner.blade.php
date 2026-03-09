<section class="py-20 md:py-24 bg-gray-50 overflow-hidden">

    <div class="max-w-7xl mx-auto px-6 text-center">

        <h2 class="text-2xl md:text-4xl font-bold">
            <span class="text-red-600">Partner</span> Kami
        </h2>

        <p class="text-gray-500 mt-2 md:mt-3 text-sm md:text-base">
            Perusahaan yang telah mempercayai layanan kami
        </p>

    </div>


    <div x-data="logoSlider()" x-init="start()" class="relative mt-10 md:mt-16 overflow-hidden">

        <!-- gradient kiri -->
        <div class="absolute left-0 top-0 w-16 md:w-40 h-full bg-gradient-to-r from-gray-50 to-transparent z-10"></div>

        <!-- gradient kanan -->
        <div class="absolute right-0 top-0 w-16 md:w-40 h-full bg-gradient-to-l from-gray-50 to-transparent z-10"></div>


        <div class="flex">

            <div x-ref="track" class="flex items-center gap-10 md:gap-20"
                :style="'transform: translateX(-' + scroll + 'px)'" @mouseenter="pause=true" @mouseleave="pause=false">

                <template x-for="logo in logos">

                    <img :src="logo"
                        class="h-6 md:h-10 lg:h-16
    hover:scale-110
    transition duration-500">

                </template>


                <!-- duplicate for infinite -->
                <template x-for="logo in logos">

                    <img :src="logo"
                        class="h-6 md:h-10 lg:h-12
    hover:scale-110
    transition duration-500">

                </template>

            </div>

        </div>

    </div>

</section>

<script>
    function logoSlider() {

        return {

            scroll: 0,
            pause: false,

            speed: window.innerWidth < 768 ? 0.15 : 0.35,

            logos: [
                "/assets/images/partner/logo-acer.webp",
                "/assets/images/partner/logo-aga.webp",
                "/assets/images/partner/logo-akr.webp",
                "/assets/images/partner/logo-asus.webp",
                "/assets/images/partner/logo-bank-jatim.webp",
                "/assets/images/partner/logo-bosch.webp",
                "/assets/images/partner/logo-hock.jpeg",
                "/assets/images/partner/logo-hp.webp",
                "/assets/images/partner/logo-jnt.webp",
                "/assets/images/partner/logo-le-minerale.webp",
                "/assets/images/partner/logo-maxxis.webp",
                "/assets/images/partner/logo-mayora.webp",
                "/assets/images/partner/logo-oppo.webp",
                "/assets/images/partner/logo-paragon.webp",
                "/assets/images/partner/logo-pucuk-harum.webp",
                "/assets/images/partner/logo-sharp.webp",
                "/assets/images/partner/logo-shunda-plafon.webp",
                "/assets/images/partner/logo-ssa.webp",
                "/assets/images/partner/logo-ubs-webp",
                "/assets/images/partner/logo-vivo.webp"
            ],

            start() {

                setInterval(() => {

                    if (!this.pause) {

                        this.scroll += this.speed

                        if (this.scroll >= this.$refs.track.scrollWidth / 2) {
                            this.scroll = 0
                        }

                    }

                }, 16)

            }

        }

    }
</script>
