<!-- FLOATING WHATSAPP -->
<aside aria-label="Quick contact" class="fixed bottom-6 right-6 z-40">
    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($whatsappMessage) }}" target="_blank" rel="noopener noreferrer"
        aria-label="Contact us on WhatsApp"
        class="w-13 h-13 sm:w-14 sm:h-14 rounded-full bg-emerald-500 hover:bg-emerald-600 text-white flex items-center justify-center shadow-lg hover:shadow-xl hover:scale-105 transition-all">
        <i class="fa-brands fa-whatsapp text-2xl sm:text-3xl"></i>
    </a>
</aside>
