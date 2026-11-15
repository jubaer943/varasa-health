<!-- Top Institutional Bar -->
<aside aria-label="Emergency helpline" class="bg-slate-900 text-slate-300 text-xs py-2 px-4 border-b border-slate-800">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
        <div class="flex items-center gap-2.5">
            <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 font-semibold text-[11px] border border-emerald-500/20">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                24/7 Home Care Dispatch
            </span>
            <span class="text-slate-400">{{ $serviceArea }}</span>
        </div>
        <div class="flex items-center gap-4 text-slate-300">
            <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="hover:text-emerald-400 transition-colors flex items-center gap-1.5 font-medium">
                <i class="fa-solid fa-phone-volume text-brand-400"></i>
                <span>Helpline: <strong class="text-white font-bold">{{ $helplineNumber }}</strong></span>
            </a>
            <span class="text-slate-700">|</span>
            <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($whatsappMessage) }}" target="_blank" rel="noopener noreferrer" class="hover:text-emerald-400 transition-colors flex items-center gap-1.5 font-medium">
                <i class="fa-brands fa-whatsapp text-emerald-400"></i>
                <span>WhatsApp</span>
            </a>
            <span class="text-slate-700 hidden md:inline">|</span>
            <a href="{{ route('login') }}" class="hidden md:flex items-center gap-1 text-slate-400 hover:text-white transition-colors">
                <i class="fa-solid fa-lock text-[10px]"></i> Staff Portal
            </a>
        </div>
    </div>
</aside>

<!-- Main Navigation Bar -->
<header class="sticky top-0 z-50 glass-nav border-b border-slate-200 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 focus:outline-none">
                <img src="{{ asset('assets/images/auth logo.png') }}" alt="Varasa Health" class="h-10 w-auto object-contain" onerror="this.style.display='none'; document.getElementById('logo-fallback').style.display='flex';">
                <div id="logo-fallback" class="hidden items-center gap-2">
                    <div class="w-9 h-9 rounded-md bg-brand-600 flex items-center justify-center text-white font-bold">
                        <i class="fa-solid fa-heart-pulse"></i>
                    </div>
                    <span class="text-2xl font-black tracking-tight text-slate-900">varasa</span>
                </div>
            </a>

            <!-- Desktop Nav Links -->
            <nav class="hidden lg:flex items-center gap-6 font-semibold text-slate-700 text-sm">
                <a href="{{ route('about') }}" class="hover:text-brand-600 transition-colors py-2">About Us</a>
                <a href="{{ route('services') }}" class="hover:text-brand-600 transition-colors py-2">Services</a>
                <a href="{{ route('how-it-works') }}" class="hover:text-brand-600 transition-colors py-2">How It Works</a>
                <a href="{{ route('safety-standards') }}" class="hover:text-brand-600 transition-colors py-2">Safety Standards</a>
                <a href="{{ route('pricing') }}" class="hover:text-brand-600 transition-colors py-2">Pricing</a>
                <a href="{{ route('app-features') }}" class="hover:text-brand-600 transition-colors py-2">App Features</a>
                <a href="{{ route('faqs') }}" class="hover:text-brand-600 transition-colors py-2">FAQs</a>
            </nav>

            <!-- Header Actions -->
            <div class="hidden md:flex items-center gap-3">
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}"
                    class="text-xs font-bold text-slate-800 bg-white hover:bg-slate-100 px-3.5 py-2 rounded-md transition-all border border-slate-200 flex items-center gap-1.5">
                    <i class="fa-solid fa-phone text-brand-600"></i> {{ $helplineNumber }}
                </a>
                @if(!empty($androidUrl) || !empty($iosUrl))
                    <a href="{{ route('app-features') }}"
                        class="bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs uppercase tracking-wider px-4 py-2.5 rounded-md shadow-sm transition-all flex items-center gap-2">
                        <i class="fa-solid fa-download"></i> Get App
                    </a>
                @else
                    <a href="{{ route('pricing') }}"
                        class="bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs uppercase tracking-wider px-4 py-2.5 rounded-md shadow-sm transition-all flex items-center gap-2">
                        <i class="fa-solid fa-calendar-check"></i> Book Care
                    </a>
                @endif
            </div>

            <!-- Mobile menu toggle -->
            <div class="lg:hidden flex items-center gap-2">
                <a href="{{ route('delete-account') }}"
                    class="text-[11px] font-semibold text-rose-600 bg-rose-50 px-2.5 py-1.5 rounded-md border border-rose-200">
                    Delete Data
                </a>
                <button id="mobile-menu-btn" aria-label="Toggle mobile navigation menu"
                    class="p-2 rounded-md text-slate-700 hover:text-slate-900 hover:bg-slate-100 transition-colors border border-slate-200">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div id="mobile-menu" class="hidden lg:hidden bg-white border-b border-slate-200 px-6 py-6 space-y-4 shadow-xl">
        <nav class="flex flex-col space-y-3 font-semibold text-slate-700 text-sm">
            <a href="{{ route('about') }}" onclick="closeMobileMenu()" class="py-2 border-b border-slate-100 hover:text-brand-600 flex items-center justify-between">
                <span>About Varasa Health</span> <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
            </a>
            <a href="{{ route('services') }}" onclick="closeMobileMenu()" class="py-2 border-b border-slate-100 hover:text-brand-600 flex items-center justify-between">
                <span>Clinical Services</span> <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
            </a>
            <a href="{{ route('how-it-works') }}" onclick="closeMobileMenu()" class="py-2 border-b border-slate-100 hover:text-brand-600 flex items-center justify-between">
                <span>How It Works</span> <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
            </a>
            <a href="{{ route('safety-standards') }}" onclick="closeMobileMenu()" class="py-2 border-b border-slate-100 hover:text-brand-600 flex items-center justify-between">
                <span>Safety & Standards</span> <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
            </a>
            <a href="{{ route('pricing') }}" onclick="closeMobileMenu()" class="py-2 border-b border-slate-100 hover:text-brand-600 flex items-center justify-between">
                <span>Care Pricing Matrix</span> <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
            </a>
            <a href="{{ route('app-features') }}" onclick="closeMobileMenu()" class="py-2 border-b border-slate-100 hover:text-brand-600 flex items-center justify-between">
                <span>Patient & Staff App</span> <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
            </a>
            <a href="{{ route('faqs') }}" onclick="closeMobileMenu()" class="py-2 border-b border-slate-100 hover:text-brand-600 flex items-center justify-between">
                <span>Frequently Asked Questions</span> <i class="fa-solid fa-chevron-right text-xs text-slate-400"></i>
            </a>
        </nav>
        <div class="pt-2 flex flex-col gap-2.5">
            <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="w-full text-center py-2.5 bg-slate-900 text-white font-bold rounded-md text-sm flex items-center justify-center gap-2">
                <i class="fa-solid fa-phone-volume text-brand-400"></i> Call Helpline {{ $helplineNumber }}
            </a>
            @if(!empty($androidUrl) || !empty($iosUrl))
                <a href="{{ route('app-features') }}" onclick="closeMobileMenu()"
                    class="w-full text-center py-2.5 bg-brand-600 text-white font-bold rounded-md text-sm shadow-sm flex items-center justify-center gap-2">
                    <i class="fa-solid fa-download"></i> Download App
                </a>
            @else
                <a href="{{ route('pricing') }}" onclick="closeMobileMenu()"
                    class="w-full text-center py-2.5 bg-brand-600 text-white font-bold rounded-md text-sm shadow-sm flex items-center justify-center gap-2">
                    <i class="fa-solid fa-calendar-check"></i> Book Care Now
                </a>
            @endif
            <a href="{{ route('delete-account') }}" onclick="closeMobileMenu()"
                class="w-full text-center py-2.5 text-rose-600 bg-rose-50 font-semibold rounded-md border border-rose-200 text-xs flex items-center justify-center gap-1.5">
                <i class="fa-solid fa-shield-halved"></i> Google Play Account Deletion Request
            </a>
        </div>
    </div>
</header>
