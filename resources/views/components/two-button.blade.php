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
            window.location.href = "tel:+628123456789";
        } else {
            window.location.href = "https://wa.me/628123456789";
        }
    }
</script>
