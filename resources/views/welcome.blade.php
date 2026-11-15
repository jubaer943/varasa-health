@extends('layouts.frontend')

@section('title', 'Varasa Health - Professional Home Nursing, Elderly Care & Healthcare')

@section('content')



        <!-- ================= LANDING PAGE CONTENT ================= -->
        <main class="space-y-24 pb-20">

            <!-- HERO SECTION -->
            <section class="relative overflow-hidden pt-10 lg:pt-16 pb-12 bg-white border-b border-slate-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                        <!-- Left Hero Column: Copy & Trust Signals -->
                        <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                            
                            <!-- Institutional Tag -->
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded bg-slate-100 border border-slate-200 text-slate-700 text-xs font-bold tracking-wide uppercase">
                                <span class="w-2 h-2 rounded-full bg-brand-600"></span>
                                <span>Verified Healthcare Network</span>
                                <span class="text-slate-300">|</span>
                                <span class="text-brand-700 font-semibold">Dhaka Metro</span>
                            </div>

                            <!-- Main Headline -->
                            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight">
                                {!! !empty($siteSettings['hero_title']) ? nl2br(e($siteSettings['hero_title'])) : 'Hospital-Grade Medical Care & Verified Nurses, <br class="hidden sm:inline"><span class="text-brand-600">Delivered to Your Home.</span>' !!}
                            </h1>

                            <!-- Value Proposition -->
                            <p class="text-base text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                                {{ !empty($siteSettings['hero_subtitle']) ? $siteSettings['hero_subtitle'] : 'Book qualified nurses, senior caregivers, physiotherapists, and home diagnostic tests through Varasa Health. Triple-screened staff, doctor tele-supervision, and transparent fixed pricing across Dhaka.' }}
                            </p>

                            <!-- CTAs -->
                            <div class="pt-2 space-y-4">
                                <div class="flex flex-wrap justify-center lg:justify-start items-center gap-3">
                                    @if(!empty($androidUrl))
                                        <!-- Google Play CTA -->
                                        <a href="{{ $androidUrl }}" target="_blank" rel="noopener noreferrer"
                                            class="flex items-center gap-3 bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-md transition-all border border-slate-800">
                                            <i class="fa-brands fa-google-play text-xl text-brand-400"></i>
                                            <div class="text-left">
                                                <div class="text-[9px] uppercase tracking-wider text-slate-400 font-medium">Get it on</div>
                                                <div class="text-xs font-bold tracking-tight">Google Play</div>
                                            </div>
                                        </a>
                                    @endif

                                    @if(!empty($iosUrl))
                                        <!-- Apple App Store CTA -->
                                        <a href="{{ $iosUrl }}" target="_blank" rel="noopener noreferrer"
                                            class="flex items-center gap-3 bg-slate-900 hover:bg-slate-800 text-white px-5 py-2.5 rounded-md transition-all border border-slate-800">
                                            <i class="fa-brands fa-apple text-xl text-white"></i>
                                            <div class="text-left">
                                                <div class="text-[9px] uppercase tracking-wider text-slate-400 font-medium">Download on</div>
                                                <div class="text-xs font-bold tracking-tight">App Store</div>
                                            </div>
                                        </a>
                                    @endif

                                    <!-- Hotline Call Button -->
                                    <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}"
                                        class="flex items-center gap-2.5 bg-slate-100 hover:bg-slate-200 text-slate-900 px-4 py-2.5 rounded-md border border-slate-300 transition-all">
                                        <i class="fa-solid fa-phone-volume text-brand-600 text-sm"></i>
                                        <div class="text-left">
                                            <div class="text-[9px] uppercase tracking-wider text-slate-500 font-semibold">24/7 Helpline</div>
                                            <div class="text-xs font-bold text-slate-900">{{ $helplineNumber }}</div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Special Offer Banner -->
                                <div class="inline-flex items-center gap-2.5 bg-emerald-50 border border-emerald-200 text-emerald-900 px-3.5 py-2 rounded-md text-xs font-medium">
                                    <span class="bg-brand-600 text-white font-bold text-[10px] px-2 py-0.5 rounded tracking-wide uppercase">
                                        35% OFF
                                    </span>
                                    <span>Special Discount on First Nurse Shift Booking · Promo Code: <strong class="font-bold text-emerald-800">VARASA35</strong></span>
                                </div>
                            </div>

                            <!-- Trust Proof Stats Bar -->
                            <div class="pt-6 border-t border-slate-200 grid grid-cols-2 sm:grid-cols-4 gap-4 text-center lg:text-left">
                                <div class="p-3 bg-slate-50 rounded-md border border-slate-200">
                                    <div class="text-2xl font-extrabold text-slate-900">10,000+</div>
                                    <div class="text-[11px] text-slate-500 font-medium mt-0.5">Care Shifts Done</div>
                                </div>
                                <div class="p-3 bg-slate-50 rounded-md border border-slate-200">
                                    <div class="text-2xl font-extrabold text-slate-900">100%</div>
                                    <div class="text-[11px] text-slate-500 font-medium mt-0.5">NID & Police Vetted</div>
                                </div>
                                <div class="p-3 bg-slate-50 rounded-md border border-slate-200">
                                    <div class="text-2xl font-extrabold text-slate-900 flex items-center justify-center lg:justify-start gap-1">
                                        <span>4.9</span> <i class="fa-solid fa-star text-amber-500 text-base"></i>
                                    </div>
                                    <div class="text-[11px] text-slate-500 font-medium mt-0.5">2,500+ Reviews</div>
                                </div>
                                <div class="p-3 bg-slate-50 rounded-md border border-slate-200">
                                    <div class="text-2xl font-extrabold text-brand-600">15 min</div>
                                    <div class="text-[11px] text-slate-500 font-medium mt-0.5">Rapid Response</div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Hero Column: Structured Clinical & App Preview Panel -->
                        <div class="lg:col-span-5 relative flex flex-col gap-4">
                            
                            <!-- Clinical Supervisor Dispatch Card -->
                            <div class="bg-slate-900 text-white rounded-lg p-5 border border-slate-800 shadow-lg space-y-4">
                                <div class="flex items-center justify-between border-b border-slate-800 pb-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></div>
                                        <span class="text-xs font-bold uppercase tracking-wider text-slate-300">Live Care Dispatch</span>
                                    </div>
                                    <span class="text-[10px] bg-slate-800 px-2 py-0.5 rounded text-slate-400 font-mono">ID: VR-DHAKA</span>
                                </div>

                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1594824813593-199f365518b5?auto=format&fit=crop&w=120&q=80" alt="Nurse Profile" class="w-12 h-12 rounded object-cover border border-slate-700">
                                    <div class="space-y-0.5">
                                        <div class="text-sm font-bold text-white flex items-center gap-1.5">
                                            <span>Sister Farzana, B.Sc</span>
                                            <i class="fa-solid fa-circle-check text-brand-400 text-xs"></i>
                                        </div>
                                        <div class="text-xs text-slate-400">BNC Registered Medical Assistant · 5.0 ★</div>
                                        <div class="text-[11px] text-emerald-400 font-medium">Assigned to: Banani Road 11 (Post-Surgical Care)</div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-3 gap-2 pt-2 text-center text-xs border-t border-slate-800">
                                    <div class="bg-slate-800/80 p-2 rounded">
                                        <span class="text-[10px] text-slate-400 block">Shift Timing</span>
                                        <span class="font-bold text-white">8h Day Shift</span>
                                    </div>
                                    <div class="bg-slate-800/80 p-2 rounded">
                                        <span class="text-[10px] text-slate-400 block">Patient Vitals</span>
                                        <span class="font-bold text-emerald-400">Stable</span>
                                    </div>
                                    <div class="bg-slate-800/80 p-2 rounded">
                                        <span class="text-[10px] text-slate-400 block">Doctor Check</span>
                                        <span class="font-bold text-brand-300">Verified</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile App Preview Card -->
                            <div class="bg-white rounded-lg p-5 border border-slate-200 shadow-sm space-y-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded bg-brand-600 flex items-center justify-center text-white text-xs">
                                            <i class="fa-solid fa-heart-pulse"></i>
                                        </div>
                                        <span class="font-bold text-sm text-slate-900">Varasa Health App</span>
                                    </div>
                                    <span class="text-xs font-semibold text-brand-600">iOS & Android</span>
                                </div>

                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <div class="p-2.5 bg-slate-50 rounded border border-slate-200">
                                        <div class="font-bold text-slate-900 flex items-center gap-1.5">
                                            <i class="fa-solid fa-user-nurse text-brand-600"></i> Nursing Home Care
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-1">Dressing, IV, Catheter, Injections</p>
                                    </div>
                                    <div class="p-2.5 bg-slate-50 rounded border border-slate-200">
                                        <div class="font-bold text-slate-900 flex items-center gap-1.5">
                                            <i class="fa-solid fa-wheelchair text-brand-600"></i> Senior Caregiver
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-1">12h / 24h elderly companionship</p>
                                    </div>
                                    <div class="p-2.5 bg-slate-50 rounded border border-slate-200">
                                        <div class="font-bold text-slate-900 flex items-center gap-1.5">
                                            <i class="fa-solid fa-person-walking text-brand-600"></i> Physiotherapy
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-1">Stroke & joint rehabilitation</p>
                                    </div>
                                    <div class="p-2.5 bg-slate-50 rounded border border-slate-200">
                                        <div class="font-bold text-slate-900 flex items-center gap-1.5">
                                            <i class="fa-solid fa-vials text-brand-600"></i> Home Lab Tests
                                        </div>
                                        <p class="text-[11px] text-slate-500 mt-1">Sterile sample & digital PDF</p>
                                    </div>
                                </div>

                                @if(!empty($androidUrl) || !empty($iosUrl))
                                    <div class="pt-2 flex items-center justify-between text-xs">
                                        <span class="text-slate-500 font-medium">Download now to book certified staff</span>
                                        <a href="{{ route('app-features') }}" class="text-brand-600 hover:text-brand-700 font-bold flex items-center gap-1">
                                            Install Free <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                        </a>
                                    </div>
                                @else
                                    <div class="pt-2 flex items-center justify-between text-xs">
                                        <span class="text-slate-500 font-medium">Direct Home Care Helpline Across Dhaka</span>
                                        <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="text-brand-600 hover:text-brand-700 font-bold flex items-center gap-1">
                                            Call {{ $helplineNumber }} <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>

                        </div>

                    </div>
                </div>
            </section>


            <!-- QUICK ESTIMATE & BOOKING BAR (Structured Enterprise Widget) -->
            <section id="estimate-bar" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm">
                    <div class="flex flex-col lg:flex-row items-center justify-between gap-6">
                        
                        <div class="w-full lg:w-1/4">
                            <span class="text-xs font-bold text-brand-600 uppercase tracking-wider block mb-1">
                                <i class="fa-solid fa-calculator mr-1"></i> Care Cost Estimator
                            </span>
                            <h2 class="text-lg font-extrabold text-slate-900">Instant Rate Calculator</h2>
                            <p class="text-xs text-slate-500">Official standard rates for Dhaka</p>
                        </div>

                        <!-- Selector Controls -->
                        <div class="w-full lg:w-3/4 grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div>
                                <label for="estimate-service" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Required Service</label>
                                <select id="estimate-service" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-semibold text-slate-800 focus:outline-none focus:border-brand-600">
                                    <option value="500">Registered Nurse (Daily/Shift)</option>
                                    <option value="450">Elderly Caregiver (12h Shift)</option>
                                    <option value="900">24h Dedicated Live-in Caregiver</option>
                                    <option value="800">Physiotherapy Home Session</option>
                                    <option value="600">Home Diagnostic Blood Profile</option>
                                </select>
                            </div>

                            <div>
                                <label for="estimate-duration" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Duration</label>
                                <select id="estimate-duration" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-semibold text-slate-800 focus:outline-none focus:border-brand-600">
                                    <option value="1">Single Visit / 1 Shift</option>
                                    <option value="7">Weekly Care Plan (7 Days)</option>
                                    <option value="30">Monthly Care Plan (30 Days)</option>
                                </select>
                            </div>

                            <div>
                                <label for="estimate-area" class="block text-[11px] font-bold text-slate-700 uppercase tracking-wider mb-1">Location Zone</label>
                                <select id="estimate-area" class="w-full bg-slate-50 border border-slate-300 rounded px-3 py-2 text-xs font-semibold text-slate-800 focus:outline-none focus:border-brand-600">
                                    <option>Banani / Gulshan / Baridhara</option>
                                    <option>Dhanmondi / Lalmatia</option>
                                    <option>Uttara (All Sectors)</option>
                                    <option>Mirpur / Pallabi</option>
                                    <option>Mohammadpur / Shyamoli</option>
                                    <option>Bashundhara / Badda</option>
                                    <option>Other Dhaka Zones</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    <!-- Output Bar -->
                    <div class="mt-5 pt-4 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-3">
                            <span class="text-xs text-slate-500 font-medium">Estimated Investment:</span>
                            <span id="estimate-total" class="text-2xl font-black text-brand-600">৳ 500</span>
                            <span class="text-[10px] text-emerald-800 font-semibold bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">
                                No Hidden Fees
                            </span>
                        </div>
                        <div class="flex items-center gap-3 w-full sm:w-auto">
                            <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($whatsappMessage) }}" target="_blank" rel="noopener noreferrer"
                                class="w-full sm:w-auto bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-4 py-2.5 rounded transition-all flex items-center justify-center gap-2">
                                <i class="fa-brands fa-whatsapp text-emerald-400"></i> WhatsApp Booking
                            </a>
                            @if(!empty($androidUrl) || !empty($iosUrl))
                                <a href="{{ route('app-features') }}"
                                    class="w-full sm:w-auto bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold px-5 py-2.5 rounded shadow-sm transition-all flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-mobile-screen"></i> Book in App
                                </a>
                            @else
                                <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}"
                                    class="w-full sm:w-auto bg-brand-600 hover:bg-brand-700 text-white text-xs font-bold px-5 py-2.5 rounded shadow-sm transition-all flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-phone"></i> Call to Book
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </section>


            <!-- SERVICES SECTION (With Authentic Icons, Structured Cards) -->
            <section id="services" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto space-y-3">
                    <span class="text-xs font-bold text-brand-600 uppercase tracking-widest bg-brand-50 border border-brand-200 px-2.5 py-1 rounded">
                        Clinical Catalog
                    </span>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                        Clinical Healthcare Services at Home
                    </h2>
                    <p class="text-slate-600 text-sm">
                        All treatments and nursing procedures follow standard medical hygiene protocols and doctor oversight.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('services') }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded bg-brand-50 hover:bg-brand-100 text-brand-700 text-xs font-bold border border-brand-200 transition-colors">
                            <span>Browse Full Services Catalog</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <!-- Service Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-12">

                    <!-- Service Card 1 -->
                    <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm hover:border-brand-500 transition-all flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between">
                                <div class="w-14 h-14 bg-slate-50 border border-slate-200 rounded p-2 flex items-center justify-center">
                                    <img src="{{ asset('assets/images/service-1.png') }}" class="w-10 h-10 object-contain" alt="Nurse Service">
                                </div>
                                <span class="text-[10px] font-bold text-brand-700 bg-brand-50 border border-brand-200 px-2 py-0.5 rounded uppercase">
                                    Most Requested
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-slate-900 mt-5">
                                Nursing Home Service
                            </h3>
                            <p class="text-slate-600 text-xs mt-2 leading-relaxed">
                                Expert certified medical assistant nurses for surgical dressing, IV cannulation, catheter care, injections, and vitals monitoring.
                            </p>

                            <ul class="mt-4 space-y-2 text-xs text-slate-600 border-t border-slate-100 pt-3">
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-brand-600 text-[11px]"></i>
                                    <span>IV Cannulation & Medication Administration</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-brand-600 text-[11px]"></i>
                                    <span>Sterile Wound Dressing & Stitch Removal</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-brand-600 text-[11px]"></i>
                                    <span>Catheter Insertion & Ryle's Tube Care</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 block uppercase font-bold">Starting Rate</span>
                                <span class="text-sm font-extrabold text-slate-900">৳500 / Shift</span>
                            </div>
                            <a href="{{ route('services') }}"
                                class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                                <span>Details & Pricing</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Service Card 2 -->
                    <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm hover:border-brand-500 transition-all flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between">
                                <div class="w-14 h-14 bg-slate-50 border border-slate-200 rounded p-2 flex items-center justify-center">
                                    <img src="{{ asset('assets/images/service-3.png') }}" class="w-10 h-10 object-contain" alt="Caregiver Service">
                                </div>
                                <span class="text-[10px] font-bold text-emerald-800 bg-emerald-50 border border-emerald-200 px-2 py-0.5 rounded uppercase">
                                    12h / 24h Options
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-slate-900 mt-5">
                                Nurse Caregiver & Senior Care
                            </h3>
                            <p class="text-slate-600 text-xs mt-2 leading-relaxed">
                                Dedicated, empathetic caregivers for elderly loved ones, stroke recovery, dementia care, and round-the-clock home assistance.
                            </p>

                            <ul class="mt-4 space-y-2 text-xs text-slate-600 border-t border-slate-100 pt-3">
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-emerald-600 text-[11px]"></i>
                                    <span>12h Day/Night or 24/7 Dedicated Live-in Care</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-emerald-600 text-[11px]"></i>
                                    <span>Personal Hygiene, Bathing & Diaper Care</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-emerald-600 text-[11px]"></i>
                                    <span>Feeding Assistance, Mobility & Bed Sore Prevention</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 block uppercase font-bold">Starting Rate</span>
                                <span class="text-sm font-extrabold text-slate-900">Weekly & Monthly</span>
                            </div>
                            <a href="{{ route('services') }}"
                                class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                                <span>Details & Pricing</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Service Card 3 -->
                    <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm hover:border-brand-500 transition-all flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between">
                                <div class="w-14 h-14 bg-slate-50 border border-slate-200 rounded p-2 flex items-center justify-center">
                                    <img src="{{ asset('assets/images/service-2.png') }}" class="w-10 h-10 object-contain" alt="Physiotherapy Service">
                                </div>
                                <span class="text-[10px] font-bold text-teal-800 bg-teal-50 border border-teal-200 px-2 py-0.5 rounded uppercase">
                                    Specialist Led
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-slate-900 mt-5">
                                Physiotherapy Home Service
                            </h3>
                            <p class="text-slate-600 text-xs mt-2 leading-relaxed">
                                Targeted physical therapy sessions for stroke recovery, paralysis, chronic joint pain, sports injuries, and post-surgery rehabilitation.
                            </p>

                            <ul class="mt-4 space-y-2 text-xs text-slate-600 border-t border-slate-100 pt-3">
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-teal-600 text-[11px]"></i>
                                    <span>Post-Stroke Neurological Motor Recovery</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-teal-600 text-[11px]"></i>
                                    <span>Orthopedic Fracture & Joint Mobility Therapy</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-teal-600 text-[11px]"></i>
                                    <span>Back, Knee & Neck Pain Physical Exercises</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 block uppercase font-bold">Starting Rate</span>
                                <span class="text-sm font-extrabold text-slate-900">৳800 / Session</span>
                            </div>
                            <a href="{{ route('services') }}"
                                class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                                <span>Details & Pricing</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Service Card 4 -->
                    <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm hover:border-brand-500 transition-all flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between">
                                <div class="w-14 h-14 bg-slate-50 border border-slate-200 rounded p-2 flex items-center justify-center">
                                    <img src="{{ asset('assets/images/service-4.png') }}" class="w-10 h-10 object-contain" alt="Diagnostic Service">
                                </div>
                                <span class="text-[10px] font-bold text-cyan-800 bg-cyan-50 border border-cyan-200 px-2 py-0.5 rounded uppercase">
                                    Digital PDF Reports
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-slate-900 mt-5">
                                Home Diagnostic Tests
                            </h3>
                            <p class="text-slate-600 text-xs mt-2 leading-relaxed">
                                Doorstep sterile blood and urine sample collection by trained phlebotomists. Accredited laboratory tests with reports in app.
                            </p>

                            <ul class="mt-4 space-y-2 text-xs text-slate-600 border-t border-slate-100 pt-3">
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-cyan-600 text-[11px]"></i>
                                    <span>CBC, Blood Sugar, HbA1c & Lipid Profile</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-cyan-600 text-[11px]"></i>
                                    <span>Kidney (Creatinine) & Liver Function (SGPT)</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-cyan-600 text-[11px]"></i>
                                    <span>Digital PDF Report in App within 6-12h</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 block uppercase font-bold">Packages</span>
                                <span class="text-sm font-extrabold text-slate-900">Discounted Bundles</span>
                            </div>
                            <a href="{{ route('services') }}"
                                class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                                <span>Details & Pricing</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Service Card 5 -->
                    <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm hover:border-brand-500 transition-all flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between">
                                <div class="w-14 h-14 bg-slate-50 border border-slate-200 rounded p-2 flex items-center justify-center">
                                    <img src="{{ asset('assets/images/service-5.png') }}" class="w-10 h-10 object-contain" alt="Doctor Consultation">
                                </div>
                                <span class="text-[10px] font-bold text-blue-800 bg-blue-50 border border-blue-200 px-2 py-0.5 rounded uppercase">
                                    Instant Tele-Consult
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-slate-900 mt-5">
                                Doctor Video Consultation
                            </h3>
                            <p class="text-slate-600 text-xs mt-2 leading-relaxed">
                                Connect with BMDC-verified MBBS doctors online for second opinions, lab report reviews, and authorized digital prescriptions.
                            </p>

                            <ul class="mt-4 space-y-2 text-xs text-slate-600 border-t border-slate-100 pt-3">
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-blue-600 text-[11px]"></i>
                                    <span>Verified General Physicians & Specialists</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-blue-600 text-[11px]"></i>
                                    <span>BMDC Authorized Digital E-Prescriptions</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-blue-600 text-[11px]"></i>
                                    <span>Doctor Review of Ongoing Caregiver Logs</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 block uppercase font-bold">Consult Fee</span>
                                <span class="text-sm font-extrabold text-slate-900">From ৳300</span>
                            </div>
                            <a href="{{ route('services') }}"
                                class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                                <span>Details & Pricing</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Service Card 6 -->
                    <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm hover:border-brand-500 transition-all flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between">
                                <div class="w-14 h-14 bg-slate-50 border border-slate-200 rounded p-2 flex items-center justify-center">
                                    <img src="{{ asset('assets/images/service-6.png') }}" class="w-10 h-10 object-contain" alt="Medicine Delivery">
                                </div>
                                <span class="text-[10px] font-bold text-rose-800 bg-rose-50 border border-rose-200 px-2 py-0.5 rounded uppercase">
                                    100% Genuine
                                </span>
                            </div>

                            <h3 class="text-lg font-bold text-slate-900 mt-5">
                                Prescription Medicine Delivery
                            </h3>
                            <p class="text-slate-600 text-xs mt-2 leading-relaxed">
                                Upload your doctor's prescription and get genuine, temperature-regulated medicines delivered straight to your home with discounts.
                            </p>

                            <ul class="mt-4 space-y-2 text-xs text-slate-600 border-t border-slate-100 pt-3">
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-rose-600 text-[11px]"></i>
                                    <span>Direct from Licensed DGDA Pharmacies</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-rose-600 text-[11px]"></i>
                                    <span>Cold-Chain Maintained for Insulin & Biologics</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-rose-600 text-[11px]"></i>
                                    <span>Same-Day Safe Delivery in Dhaka</span>
                                </li>
                            </ul>
                        </div>

                        <div class="mt-6 pt-3 border-t border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 block uppercase font-bold">Delivery</span>
                                <span class="text-sm font-extrabold text-slate-900">Same-Day Dhaka</span>
                            </div>
                            <a href="{{ route('services') }}"
                                class="text-xs font-bold text-brand-600 hover:text-brand-700 flex items-center gap-1">
                                <span>Details & Pricing</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </section>


            <!-- HOW IT WORKS (Structured Process Grid) -->
            <section id="how-it-works" class="bg-slate-900 text-white py-16 border-y border-slate-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                    <div class="text-center max-w-3xl mx-auto space-y-3">
                        <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest bg-emerald-500/10 border border-emerald-500/30 px-2.5 py-1 rounded">
                            Standard Operating Workflow
                        </span>
                        <h2 class="text-3xl font-extrabold tracking-tight">
                            Healthcare at Home in 3 Clear Steps
                        </h2>
                        <p class="text-slate-400 text-sm">
                            A streamlined, clinically supervised protocol for patient comfort and family reassurance.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                        
                        <!-- Step 1 -->
                        <div class="bg-slate-800 rounded-lg p-6 border border-slate-700 space-y-3">
                            <div class="w-10 h-10 rounded bg-brand-500/20 text-brand-400 flex items-center justify-center text-sm font-black border border-brand-500/30">
                                01
                            </div>
                            <h3 class="text-base font-bold text-white">Select Care Plan & Shift</h3>
                            <p class="text-slate-400 text-xs leading-relaxed">
                                Choose nursing care, senior caregiver, physiotherapy, or home test. Select shift timing (8h, 12h, or 24h) and gender preferences.
                            </p>
                        </div>

                        <!-- Step 2 -->
                        <div class="bg-slate-800 rounded-lg p-6 border border-slate-700 space-y-3">
                            <div class="w-10 h-10 rounded bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-sm font-black border border-emerald-500/30">
                                02
                            </div>
                            <h3 class="text-base font-bold text-white">Matched with Verified Staff</h3>
                            <p class="text-slate-400 text-xs leading-relaxed">
                                We assign a certified, background-checked professional tailored to the patient's medical condition. View their credentials in app.
                            </p>
                        </div>

                        <!-- Step 3 -->
                        <div class="bg-slate-800 rounded-lg p-6 border border-slate-700 space-y-3">
                            <div class="w-10 h-10 rounded bg-teal-500/20 text-teal-400 flex items-center justify-center text-sm font-black border border-teal-500/30">
                                03
                            </div>
                            <h3 class="text-base font-bold text-white">Supervised Care at Home</h3>
                            <p class="text-slate-400 text-xs leading-relaxed">
                                Caregiver arrives on schedule. Our clinical coordinator tracks daily reports, patient vitals, and guarantees prompt replacement if needed.
                            </p>
                        </div>

                    </div>

                </div>
            </section>


            <!-- TRUST & SAFETY SECTION (Structured Credibility Framework) -->
            <section id="trust" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto space-y-3">
                    <span class="text-xs font-bold text-brand-600 uppercase tracking-widest bg-brand-50 border border-brand-200 px-2.5 py-1 rounded">
                        Institutional Governance
                    </span>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                        Clinical Safety & Vetting Standards
                    </h2>
                    <p class="text-slate-600 text-sm">
                        Every professional on the Varasa platform is held to strict accreditation and background security standards.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mt-12">
                    
                    <div class="p-5 rounded-lg bg-white border border-slate-200 shadow-sm space-y-3">
                        <div class="w-10 h-10 rounded bg-slate-100 text-slate-800 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-id-card-clip"></i>
                        </div>
                        <h3 class="text-sm font-bold text-slate-900">National NID & Police Check</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Every employee undergoes bio-data validation, permanent residence physical verification, and police clearance screening.
                        </p>
                    </div>

                    <div class="p-5 rounded-lg bg-white border border-slate-200 shadow-sm space-y-3">
                        <div class="w-10 h-10 rounded bg-brand-50 text-brand-600 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-certificate"></i>
                        </div>
                        <h3 class="text-sm font-bold text-slate-900">BNC Certified Staff</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Our registered nurses hold authentic diplomas and B.Sc certificates registered under Bangladesh Nursing & Midwifery Council.
                        </p>
                    </div>

                    <div class="p-5 rounded-lg bg-white border border-slate-200 shadow-sm space-y-3">
                        <div class="w-10 h-10 rounded bg-teal-50 text-teal-600 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <h3 class="text-sm font-bold text-slate-900">Doctor Tele-Supervision</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            Continuous teleconsultation backup by in-house physicians for patient escalation, vitals review, and treatment adjustments.
                        </p>
                    </div>

                    <div class="p-5 rounded-lg bg-white border border-slate-200 shadow-sm space-y-3">
                        <div class="w-10 h-10 rounded bg-cyan-50 text-cyan-600 flex items-center justify-center text-lg">
                            <i class="fa-solid fa-rotate"></i>
                        </div>
                        <h3 class="text-sm font-bold text-slate-900">Free Replacement Guarantee</h3>
                        <p class="text-xs text-slate-500 leading-relaxed">
                            If you or your patient are not comfortable with the assigned caregiver, we offer immediate replacement within 24 hours at no fee.
                        </p>
                    </div>

                </div>
            </section>


            <!-- CARE PRICING MATRIX / CALCULATOR -->
            <section id="calculator" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-slate-900 rounded-lg p-8 sm:p-10 text-white border border-slate-800 shadow-md">
                    
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                        
                        <div class="lg:col-span-5 space-y-4">
                            <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest bg-emerald-500/10 border border-emerald-500/30 px-2.5 py-1 rounded">
                                Standard Tariffs
                            </span>
                            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                                Transparent Caregiver & Nursing Rates
                            </h2>
                            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                                Select shift requirements to review estimated investment. All packages include emergency replacements and medical supervisor support.
                            </p>
                            
                            <div class="space-y-2 pt-2 text-xs text-slate-300">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-emerald-400"></i>
                                    <span>Zero agency registration or admission fees</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-emerald-400"></i>
                                    <span>Complimentary replacement on staff leave</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-emerald-400"></i>
                                    <span>Official digital invoice with tax compliance</span>
                                </div>
                            </div>
                        </div>

                        <!-- Calculator Box -->
                        <div class="lg:col-span-7 bg-white text-slate-900 rounded-lg p-6 sm:p-7 shadow-sm space-y-5">
                            
                            <!-- Shift Options -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Shift Type</label>
                                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                                    <button type="button" onclick="setShift('8h', 600, 16000)" id="shift-8h" class="shift-btn px-3 py-2 rounded border border-brand-600 bg-brand-50 text-slate-900 text-xs font-bold text-center transition-all">
                                        8 Hours (Day)
                                    </button>
                                    <button type="button" onclick="setShift('12h', 800, 22000)" id="shift-12h" class="shift-btn px-3 py-2 rounded border border-slate-200 hover:border-slate-400 bg-white text-slate-700 text-xs font-bold text-center transition-all">
                                        12 Hours (Day/Night)
                                    </button>
                                    <button type="button" onclick="setShift('24h', 1400, 38000)" id="shift-24h" class="shift-btn px-3 py-2 rounded border border-slate-200 hover:border-slate-400 bg-white text-slate-700 text-xs font-bold text-center transition-all">
                                        24h Full Live-in
                                    </button>
                                    <button type="button" onclick="setShift('visit', 500, 12000)" id="shift-visit" class="shift-btn px-3 py-2 rounded border border-slate-200 hover:border-slate-400 bg-white text-slate-700 text-xs font-bold text-center transition-all">
                                        Single Visit
                                    </button>
                                </div>
                            </div>

                            <!-- Duration Selection -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Commitment</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="flex items-center gap-2.5 p-3 rounded border border-brand-600 bg-brand-50/50 cursor-pointer">
                                        <input type="radio" name="plan_type" value="daily" checked onchange="updateCalc()" class="text-brand-600 focus:ring-brand-600">
                                        <div>
                                            <div class="text-xs font-bold text-slate-900">Per Shift / Flexible</div>
                                            <div class="text-[10px] text-slate-500">Pay as needed</div>
                                        </div>
                                    </label>
                                    <label class="flex items-center gap-2.5 p-3 rounded border border-slate-200 hover:border-slate-300 cursor-pointer">
                                        <input type="radio" name="plan_type" value="monthly" onchange="updateCalc()" class="text-brand-600 focus:ring-brand-600">
                                        <div>
                                            <div class="text-xs font-bold text-slate-900">Monthly Retainer</div>
                                            <div class="text-[10px] text-emerald-700 font-bold">Save up to 25%</div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Display Banner -->
                            <div class="bg-slate-50 p-4 rounded border border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-3">
                                <div>
                                    <span class="text-[10px] font-bold text-slate-500 block uppercase">Estimated Tariff</span>
                                    <div class="text-2xl font-black text-brand-600" id="calc-price-display">৳ 600 <span class="text-xs font-normal text-slate-500">/ shift</span></div>
                                </div>
                                <div class="text-right sm:text-left text-xs text-slate-500">
                                    <span class="block text-[11px] text-emerald-800 font-bold"><i class="fa-solid fa-check mr-1"></i> Food & Transport Terms Included</span>
                                    <span class="text-[10px]">Verified Staff & Guarantee</span>
                                </div>
                            </div>

                            <!-- CTA Button -->
                            <div>
                                <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-bold py-3 rounded text-center text-xs flex items-center justify-center gap-2 transition-all">
                                    <i class="fa-solid fa-phone-volume text-brand-400"></i> Book This Plan: Call {{ $helplineNumber }}
                                </a>
                            </div>

                        </div>

                    </div>

                </div>
            </section>


            <!-- DUAL APP ECOSYSTEM (Structured Side-by-Side Cards) -->
            <section id="dual-app" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto space-y-3">
                    <span class="text-xs font-bold text-brand-600 uppercase tracking-widest bg-brand-50 border border-brand-200 px-2.5 py-1 rounded">
                        Connected Technology
                    </span>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                        Two Dedicated Mobile Platforms
                    </h2>
                    <p class="text-slate-600 text-sm">
                        Streamlining communication between patient families and registered healthcare staff.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-12">
                    
                    <!-- For Patients Card -->
                    <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm space-y-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded bg-brand-600 text-white flex items-center justify-center text-lg">
                                <i class="fa-solid fa-hospital-user"></i>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-brand-700 bg-brand-50 px-2 py-0.5 rounded border border-brand-200">Patient & Family</span>
                                <h3 class="text-xl font-bold text-slate-900 mt-0.5">Varasa Patient App</h3>
                            </div>
                        </div>

                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                            Total transparency and reassurance for family members monitoring the medical routine of their loved ones.
                        </p>

                        <ul class="space-y-3 text-xs sm:text-sm text-slate-700">
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check text-brand-600 mt-1 text-xs"></i>
                                <span><strong>Nurse Credential Validation:</strong> View registered diploma credentials, patient ratings, and past shift counts.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check text-brand-600 mt-1 text-xs"></i>
                                <span><strong>Live Shift Logging:</strong> Monitor caregiver clock-in/out, medication log, and recorded patient vitals.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check text-brand-600 mt-1 text-xs"></i>
                                <span><strong>Secure Lab Reports Vault:</strong> Access past blood tests, doctor prescriptions, and digital receipts in one place.</span>
                            </li>
                        </ul>

                        <div class="pt-3 border-t border-slate-100">
                            @if(!empty($androidUrl))
                                <a href="{{ $androidUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-brand-600 font-bold text-xs hover:text-brand-700">
                                    <span>Get Patient App (Google Play)</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            @elseif(!empty($iosUrl))
                                <a href="{{ $iosUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-brand-600 font-bold text-xs hover:text-brand-700">
                                    <span>Get Patient App (App Store)</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            @else
                                <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="inline-flex items-center gap-1.5 text-brand-600 font-bold text-xs hover:text-brand-700">
                                    <span>Book via Care Helpline</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- For Professionals Card -->
                    <div id="professionals" class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm space-y-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded bg-slate-900 text-emerald-400 flex items-center justify-center text-lg">
                                <i class="fa-solid fa-user-nurse"></i>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">Healthcare Staff</span>
                                <h3 class="text-xl font-bold text-slate-900 mt-0.5">Varasa Professional App</h3>
                            </div>
                        </div>

                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                            Empowering nurses and caregivers with dignified income, flexible shifts, and verified safe patient environments.
                        </p>

                        <ul class="space-y-3 text-xs sm:text-sm text-slate-700">
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check text-emerald-600 mt-1 text-xs"></i>
                                <span><strong>Autonomous Shift Selection:</strong> Choose shift timings and preferred zones in Dhaka with total schedule autonomy.</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check text-emerald-600 mt-1 text-xs"></i>
                                <span><strong>Weekly Transparent Payouts:</strong> Direct earnings dashboard with fast mobile banking withdrawals (bKash/Bank).</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check text-emerald-600 mt-1 text-xs"></i>
                                <span><strong>Verified Patient Locations:</strong> All patient residences are checked by Varasa for staff safety and dignity.</span>
                            </li>
                        </ul>

                        <div class="pt-3 border-t border-slate-100">
                            @if(!empty($androidUrl))
                                <a href="{{ $androidUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-emerald-700 font-bold text-xs hover:text-emerald-800">
                                    <span>Staff App (Google Play)</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            @elseif(!empty($iosUrl))
                                <a href="{{ $iosUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-emerald-700 font-bold text-xs hover:text-emerald-800">
                                    <span>Staff App (App Store)</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            @else
                                <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="inline-flex items-center gap-1.5 text-emerald-700 font-bold text-xs hover:text-emerald-800">
                                    <span>Register as Staff</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            </section>


            <!-- TESTIMONIALS (Structured Grid) -->
            <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto space-y-3">
                    <span class="text-xs font-bold text-brand-600 uppercase tracking-widest bg-brand-50 border border-brand-200 px-2.5 py-1 rounded">
                        Family Feedback
                    </span>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                        Client Testimonials Across Dhaka
                    </h2>
                    <p class="text-slate-600 text-sm">
                        Verified patient stories from families who rely on Varasa for specialized home health care.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                    
                    <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm flex flex-col justify-between">
                        <div class="space-y-3">
                            <div class="flex items-center gap-1 text-amber-500 text-xs">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="text-slate-700 text-xs leading-relaxed">
                                "My mother needed post-operative wound dressing and IV medication after her hip surgery in Banani. Sister Nasreen was exceptionally gentle, sterile, and punctual. Having her visit eliminated exhausting trips to clinics."
                            </p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-100 flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-xs">
                                FA
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-900">Farhan Ahmed</div>
                                <div class="text-[10px] text-slate-500">Banani, Dhaka · Verified Booking</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm flex flex-col justify-between">
                        <div class="space-y-3">
                            <div class="flex items-center gap-1 text-amber-500 text-xs">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="text-slate-700 text-xs leading-relaxed">
                                "Finding an honest 24/7 caregiver for my 84-year-old father with Alzheimer's was nearly impossible. Varasa provided a trained caregiver who takes care of his meals, walks, and hygiene like family."
                            </p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-100 flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-xs">
                                NJ
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-900">Dr. Nusrat Jahan</div>
                                <div class="text-[10px] text-slate-500">Dhanmondi, Dhaka · Verified Booking</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm flex flex-col justify-between">
                        <div class="space-y-3">
                            <div class="flex items-center gap-1 text-amber-500 text-xs">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <p class="text-slate-700 text-xs leading-relaxed">
                                "The physiotherapist who visited our home in Uttara for my brother's post-stroke recovery was top-class. Within 3 weeks of consistent motor exercises, he regained arm movement."
                            </p>
                        </div>
                        <div class="pt-4 mt-4 border-t border-slate-100 flex items-center gap-3">
                            <div class="w-8 h-8 rounded bg-slate-100 text-slate-700 font-bold flex items-center justify-center text-xs">
                                SA
                            </div>
                            <div>
                                <div class="text-xs font-bold text-slate-900">Saiful Alam</div>
                                <div class="text-[10px] text-slate-500">Uttara Sector 4 · Verified Booking</div>
                            </div>
                        </div>
                    </div>

                </div>
            </section>


            <!-- FAQ (Dynamic Accordion) -->
            <section id="faq" class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto space-y-3">
                    <span class="text-xs font-bold text-brand-600 uppercase tracking-widest bg-brand-50 border border-brand-200 px-2.5 py-1 rounded">
                        Answers & Help
                    </span>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">
                        Frequently Asked Questions
                    </h2>
                    <p class="text-slate-600 text-sm">
                        Key questions regarding staff background checks, scheduling, and billing.
                    </p>
                    <div class="pt-1">
                        <a href="{{ route('faqs') }}" class="inline-flex items-center gap-1.5 text-brand-600 hover:text-brand-700 text-xs font-bold">
                            <span>Browse All Frequently Asked Questions</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>

                <div class="mt-10 space-y-3">
                    @forelse($faqs->take(5) as $faq)
                        <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                            <button onclick="toggleFaq({{ $faq->id }})" class="w-full p-4 text-left font-bold text-sm text-slate-900 flex justify-between items-center hover:text-brand-600 transition-colors gap-3">
                                <span>{{ $faq->question }}</span>
                                <i id="faq-icon-{{ $faq->id }}" class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform shrink-0"></i>
                            </button>
                            <div id="faq-body-{{ $faq->id }}" class="hidden px-4 pb-4 text-xs text-slate-600 leading-relaxed border-t border-slate-100 pt-3">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </section>


            @if(!empty($androidUrl) || !empty($iosUrl))
                <!-- APP DOWNLOAD CTA -->
                <section id="download" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="bg-slate-900 rounded-lg p-8 sm:p-12 text-white flex flex-col lg:flex-row items-center justify-between gap-8 border border-slate-800 shadow-md">
                        
                        <div class="space-y-3 text-center lg:text-left max-w-xl">
                            <span class="text-xs font-bold uppercase tracking-wider text-emerald-400 bg-slate-800 px-2.5 py-1 rounded">
                                Immediate Access
                            </span>
                            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                                Download the Varasa Health Application
                            </h2>
                            <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                                Book verified nurses, track live caregiver shifts, and access lab tests directly from your phone.
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 justify-center items-center">
                            @if(!empty($androidUrl))
                                <a href="{{ $androidUrl }}" target="_blank" rel="noopener noreferrer"
                                    class="flex items-center gap-3 bg-black hover:bg-slate-950 text-white px-5 py-3 rounded border border-slate-700 transition-all">
                                    <i class="fa-brands fa-google-play text-xl text-brand-400"></i>
                                    <div class="text-left">
                                        <div class="text-[9px] uppercase tracking-wider text-slate-400 font-semibold">Download for</div>
                                        <div class="text-xs font-bold">Android Device</div>
                                    </div>
                                </a>
                            @endif

                            @if(!empty($iosUrl))
                                <a href="{{ $iosUrl }}" target="_blank" rel="noopener noreferrer"
                                    class="flex items-center gap-3 bg-white text-slate-900 hover:bg-slate-100 px-5 py-3 rounded transition-all">
                                    <i class="fa-brands fa-apple text-xl text-brand-600"></i>
                                    <div class="text-left">
                                        <div class="text-[9px] uppercase tracking-wider text-slate-500 font-semibold">Download for</div>
                                        <div class="text-xs font-bold">iOS iPhone</div>
                                    </div>
                                </a>
                            @endif
                        </div>

                    </div>
                </section>
            @endif
        </main>
@endsection

@section('scripts')
<script>
    // FAQ Accordion
    function toggleFaq(index) {
        const body = document.getElementById('faq-body-' + index);
        const icon = document.getElementById('faq-icon-' + index);

        if (body.classList.contains('hidden')) {
            body.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            body.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }

    // Instant Care Estimate Bar Logic
    const estService = document.getElementById('estimate-service');
    const estDuration = document.getElementById('estimate-duration');
    const estTotal = document.getElementById('estimate-total');

    function updateEstimate() {
        if (!estService || !estDuration || !estTotal) return;
        const rate = parseInt(estService.value, 10);
        const days = parseInt(estDuration.value, 10);

        let total = rate * days;
        if (days === 7) {
            total = Math.round(total * 0.92); // 8% weekly discount
        } else if (days === 30) {
            total = Math.round(total * 0.80); // 20% monthly discount
        }

        estTotal.textContent = '৳ ' + total.toLocaleString();
    }

    if (estService && estDuration) {
        estService.addEventListener('change', updateEstimate);
        estDuration.addEventListener('change', updateEstimate);
        updateEstimate();
    }

    // Calculator Widget Logic
    let currentShiftRate = 600;
    let currentMonthlyRate = 16000;

    function setShift(type, perShiftRate, perMonthRate) {
        currentShiftRate = perShiftRate;
        currentMonthlyRate = perMonthRate;

        document.querySelectorAll('.shift-btn').forEach(btn => {
            btn.classList.remove('border-brand-600', 'bg-brand-50', 'text-slate-900');
            btn.classList.add('border-slate-200', 'bg-white', 'text-slate-700');
        });

        const activeBtn = document.getElementById('shift-' + type);
        if (activeBtn) {
            activeBtn.classList.remove('border-slate-200', 'bg-white', 'text-slate-700');
            activeBtn.classList.add('border-brand-600', 'bg-brand-50', 'text-slate-900');
        }

        updateCalc();
    }

    function updateCalc() {
        const planType = document.querySelector('input[name="plan_type"]:checked')?.value || 'daily';
        const display = document.getElementById('calc-price-display');
        if (!display) return;

        if (planType === 'monthly') {
            display.innerHTML = '৳ ' + currentMonthlyRate.toLocaleString() + ' <span class="text-xs font-normal text-slate-500">/ month</span>';
        } else {
            display.innerHTML = '৳ ' + currentShiftRate.toLocaleString() + ' <span class="text-xs font-normal text-slate-500">/ shift</span>';
        }
    }
</script>
@endsection