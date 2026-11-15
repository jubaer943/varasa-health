<!-- FOOTER -->
<footer class="bg-slate-900 text-slate-400 py-12 border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <!-- Brand Column -->
            <div class="space-y-3">
                <img src="{{ asset('assets/images/varasa logo.png') }}" alt="Varasa Logo" class="h-9 w-auto object-contain" onerror="this.style.display='none'; document.getElementById('footer-logo-fallback').style.display='flex';">
                <div id="footer-logo-fallback" class="hidden items-center gap-2">
                    <div class="w-7 h-7 rounded bg-brand-600 flex items-center justify-center text-white font-bold">
                        <i class="fa-solid fa-heart-pulse text-xs"></i>
                    </div>
                    <span class="text-lg font-black text-white tracking-tight">varasa</span>
                </div>
                <p class="text-xs leading-relaxed text-slate-400">
                    Varasa Health Home Service provides certified nursing care, senior caregivers, physiotherapy, and doorstep diagnostic tests across Dhaka Metro.
                </p>
                <div class="flex items-center gap-2 text-slate-400 pt-1">
                    <a href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" class="w-7 h-7 rounded bg-slate-800 hover:bg-brand-600 hover:text-white flex items-center justify-center text-xs transition-colors"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="{{ $linkedinUrl }}" target="_blank" rel="noopener noreferrer" class="w-7 h-7 rounded bg-slate-800 hover:bg-brand-600 hover:text-white flex items-center justify-center text-xs transition-colors"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($whatsappMessage) }}" target="_blank" rel="noopener noreferrer" class="w-7 h-7 rounded bg-slate-800 hover:bg-emerald-600 hover:text-white flex items-center justify-center text-xs transition-colors"><i class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>

            <!-- Core Services -->
            <div>
                <h4 class="text-white text-xs font-bold uppercase tracking-wider mb-3">Core Services</h4>
                <ul class="space-y-2 text-xs">
                    <li><a href="{{ route('services') }}" class="hover:text-white transition-colors">Nursing Home Service</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-white transition-colors">Senior & Caregiver Care</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-white transition-colors">Physiotherapy at Home</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-white transition-colors">Home Diagnostic Blood Tests</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-white transition-colors">Doctor Video Consultation</a></li>
                    <li><a href="{{ route('services') }}" class="hover:text-white transition-colors">Medicine Home Delivery</a></li>
                </ul>
            </div>

            <!-- Office Contact Info -->
            <div>
                <h4 class="text-white text-xs font-bold uppercase tracking-wider mb-3">Dhaka Office</h4>
                <ul class="space-y-2.5 text-xs">
                    <li class="flex items-start gap-2">
                        <i class="fa-solid fa-location-dot text-brand-400 mt-0.5"></i>
                        <span>{{ $officeAddress }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-phone text-brand-400"></i>
                        <span><a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="hover:text-white transition-colors">{{ $helplineNumber }}</a>@if(!empty($helplineAlt)), <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineAlt) }}" class="hover:text-white transition-colors">{{ $helplineAlt }}</a>@endif</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-envelope text-brand-400"></i>
                        <span><a href="mailto:{{ $supportEmail }}" class="hover:text-white transition-colors">{{ $supportEmail }}</a></span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fa-solid fa-clock text-brand-400"></i>
                        <span>24/7 Helpline & Dispatch</span>
                    </li>
                </ul>
            </div>

            <!-- Google Play Data Safety URL -->
            <div>
                <h4 class="text-white text-xs font-bold uppercase tracking-wider mb-3">Google Play Data Policy</h4>
                <p class="text-xs text-slate-400 mb-3 leading-relaxed">
                    Public portal compliant with Google Play Console User Data Safety requirements:
                </p>
                <a href="{{ route('delete-account') }}"
                    class="w-full text-left inline-flex items-center justify-between text-xs text-rose-300 hover:text-white font-semibold bg-rose-950/60 border border-rose-900 px-3 py-2 rounded transition-all">
                    <span class="flex items-center gap-2">
                        <i class="fa-solid fa-user-xmark"></i> Data Deletion Portal
                    </span>
                    <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
                <div class="mt-3 pt-3 border-t border-slate-800">
                    <a href="{{ route('login') }}" class="text-xs text-slate-400 hover:text-white flex items-center gap-1.5">
                        <i class="fa-solid fa-lock text-[10px]"></i> Staff Login Portal
                    </a>
                </div>
            </div>

        </div>

        <!-- Bottom Subfooter -->
        <div class="mt-10 pt-6 border-t border-slate-800 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 gap-3">
            <p>&copy; {{ date('Y') }} Varasa Health Home Service. All rights reserved.</p>
            <div class="flex flex-wrap gap-5 font-medium">
                <a href="{{ route('about') }}" class="hover:text-slate-300 transition-colors">About Us</a>
                <a href="{{ route('services') }}" class="hover:text-slate-300 transition-colors">Services</a>
                <a href="{{ route('how-it-works') }}" class="hover:text-slate-300 transition-colors">How It Works</a>
                <a href="{{ route('safety-standards') }}" class="hover:text-slate-300 transition-colors">Safety Standards</a>
                <a href="{{ route('pricing') }}" class="hover:text-slate-300 transition-colors">Pricing</a>
                <a href="{{ route('app-features') }}" class="hover:text-slate-300 transition-colors">App Features</a>
                <a href="{{ route('faqs') }}" class="hover:text-slate-300 transition-colors">FAQs</a>
                <a href="{{ route('privacy-policy') }}" class="hover:text-slate-300 transition-colors">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="hover:text-slate-300 transition-colors">Terms of Service</a>
                <a href="{{ route('refund-policy') }}" class="hover:text-slate-300 transition-colors">Refund Policy</a>
                <a href="{{ route('delete-account') }}" class="hover:text-rose-400 transition-colors">Google Play Data Deletion</a>
            </div>
        </div>
    </div>
</footer>
