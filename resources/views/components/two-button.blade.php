<div class="flex gap-4">
    <a href="#" onclick="contactAction(event)" target="_blank"
        class="{{ $classbg != '' ? 'bg-red-600 text-white':'bg-white text-red-600'}} px-8 py-3 rounded-lg font-semibold hover:scale-105 transition">
        Konsultasi Gratis
    </a>

    <a href="{{ url('project') }}" target="_blank"
        class="border border-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-red-600 transition">
        Lihat Portfolio
    </a>
</div>


<script>
    function contactAction(e) {
        e.preventDefault();

        if (/Android|iPhone|iPad|iPod/i.test(navigator.userAgent)) {
            window.location.href = "tel:+6282213280698";
        } else {
            window.location.href = "https://api.whatsapp.com/send?phone=6282213280698&amp;text=Halo%2C%20saya%20tertarik%20dengan%20penawaran%20di%20website%20Anda.%20Bisa%20berikan%20detail%20lebih%20lanjut%3F";
        }
    }
</script>
