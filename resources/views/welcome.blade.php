<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="ZXE_6upd1hwfYhp3_OSsR1dWYH7mnYGmLXbfOYajG9k" />
    <title>Varasa Health Home Service - Healthcare at Your Doorstep</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf9',
                            100: '#ccfbf1',
                            500: '#00a887',
                            600: '#00876c',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <!-- Google Fonts & Font Awesome Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }

        .phone-frame {
            box-shadow: 0 25px 50px -12px rgba(0, 168, 135, 0.25);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased selection:bg-brand-500 selection:text-white">

    <!-- Navigation Bar -->
    <nav
        class="fixed top-0 left-0 right-0 z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Brand Logo -->
                <a href="#" onclick="switchView('landing')" class="flex items-center gap-3 group">
                    <div
                        class="w-10 h-10 rounded-xl bg-brand-500 flex items-center justify-center text-white shadow-md shadow-brand-500/30 group-hover:scale-105 transition-transform">
                        <i class="fa-solid fa-heart-pulse text-xl"></i>
                    </div>
                    <div>
                        <span
                            class="text-2xl font-extrabold tracking-tight text-slate-900 block leading-none">varasa</span>
                        <span class="text-[10px] font-semibold tracking-wider text-brand-600 uppercase">Health Home
                            Service</span>
                    </div>
                </a>

                <!-- Desktop Nav Links -->
                <div class="hidden md:flex items-center gap-8 font-medium text-slate-600 text-sm">
                    <a href="#services" onclick="switchView('landing')"
                        class="hover:text-brand-600 transition-colors">Services</a>
                    <a href="#dual-app" onclick="switchView('landing')"
                        class="hover:text-brand-600 transition-colors">App Features</a>
                    <a href="#caregiver" onclick="switchView('landing')"
                        class="hover:text-brand-600 transition-colors">For Professionals</a>
                    <a href="#download" onclick="switchView('landing')"
                        class="hover:text-brand-600 transition-colors">Download App</a>
                </div>

                <!-- Action CTA & Delete Link -->
                <div class="hidden md:flex items-center gap-4">
                    <button onclick="switchView('delete-account')"
                        class="text-xs font-semibold text-rose-600 bg-rose-50 hover:bg-rose-100 px-3.5 py-2 rounded-lg transition-all border border-rose-200">
                        <i class="fa-solid fa-user-minus mr-1.5"></i> Delete Account
                    </button>
                    <a href="#download" onclick="switchView('landing')"
                        class="bg-brand-500 hover:bg-brand-600 text-white font-semibold text-sm px-5 py-2.5 rounded-xl shadow-lg shadow-brand-500/25 hover:shadow-brand-500/40 transition-all">
                        Get App
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center gap-2">
                    <button onclick="switchView('delete-account')"
                        class="text-xs font-semibold text-rose-600 bg-rose-50 px-2.5 py-1.5 rounded-lg border border-rose-200">
                        Delete
                    </button>
                    <button id="mobile-menu-btn"
                        class="p-2 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu"
            class="hidden md:hidden bg-white border-b border-slate-100 px-4 pt-2 pb-6 space-y-3 shadow-xl">
            <a href="#services" onclick="switchView('landing'); closeMobileMenu()"
                class="block py-2 text-slate-600 font-medium hover:text-brand-600">Services</a>
            <a href="#dual-app" onclick="switchView('landing'); closeMobileMenu()"
                class="block py-2 text-slate-600 font-medium hover:text-brand-600">App Features</a>
            <a href="#caregiver" onclick="switchView('landing'); closeMobileMenu()"
                class="block py-2 text-slate-600 font-medium hover:text-brand-600">For Professionals</a>
            <a href="#download" onclick="switchView('landing'); closeMobileMenu()"
                class="block py-2 text-slate-600 font-medium hover:text-brand-600">Download App</a>
            <div class="pt-2">
                <button onclick="switchView('delete-account'); closeMobileMenu()"
                    class="w-full text-center py-2.5 text-rose-600 bg-rose-50 font-semibold rounded-xl border border-rose-200">
                    Account Deletion Request
                </button>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT VIEW HOLDER -->
    <main id="main-view-container" class="pt-20">

        <!-- ================= LANDING PAGE SECTION ================= -->
        <div id="landing-view" class="space-y-24 pb-20">

            <!-- Hero Section -->
            <section
                class="relative overflow-hidden pt-12 lg:pt-20 bg-gradient-to-b from-brand-50/60 via-white to-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                        <!-- Left Hero Column -->
                        <div class="lg:col-span-7 space-y-8 text-center lg:text-left">
                            <div
                                class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-100/80 border border-brand-200 text-brand-800 text-xs font-semibold">
                                <span class="flex h-2 w-2 rounded-full bg-brand-500 animate-pulse"></span>
                                Trusted Professional Healthcare at Home
                            </div>

                            <h1
                                class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.15]">
                                Verified Nurses & Caregivers <span class="text-brand-500">Delivered To Your Door.</span>
                            </h1>

                            <p class="text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                                Book qualified nurses, senior caregivers, physiotherapists, doctor consultations, and
                                home diagnostic tests seamlessly through the Varasa Health App.
                            </p>

                            <!-- CTA Buttons & Stats -->
                            <div class="pt-2 space-y-6">
                                <div class="flex flex-wrap justify-center lg:justify-start gap-4">
                                    <a href="#download"
                                        class="flex items-center gap-3 bg-slate-900 hover:bg-slate-800 text-white px-6 py-3.5 rounded-2xl shadow-xl transition-all hover:-translate-y-0.5">
                                        <i class="fa-brands fa-google-play text-2xl text-brand-500"></i>
                                        <div class="text-left">
                                            <div class="text-[10px] uppercase tracking-wider text-slate-400">Get it on
                                            </div>
                                            <div class="text-sm font-bold">Google Play</div>
                                        </div>
                                    </a>
                                    <a href="#download"
                                        class="flex items-center gap-3 bg-slate-900 hover:bg-slate-800 text-white px-6 py-3.5 rounded-2xl shadow-xl transition-all hover:-translate-y-0.5">
                                        <i class="fa-brands fa-apple text-2xl text-white"></i>
                                        <div class="text-left">
                                            <div class="text-[10px] uppercase tracking-wider text-slate-400">Download on
                                                the</div>
                                            <div class="text-sm font-bold">App Store</div>
                                        </div>
                                    </a>
                                </div>

                                <!-- Offer Highlight Badge -->
                                <div
                                    class="inline-flex items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-900 px-4 py-2.5 rounded-2xl text-sm font-medium">
                                    <span class="bg-brand-500 text-white font-bold text-xs px-2.5 py-1 rounded-lg">35%
                                        OFF</span>
                                    <span>Special Offer on First Nurse Booking!</span>
                                </div>
                            </div>

                            <!-- Trust Badges -->
                            <div class="pt-6 border-t border-slate-100 grid grid-cols-3 gap-4 text-center lg:text-left">
                                <div>
                                    <div class="text-2xl font-bold text-slate-900">100%</div>
                                    <div class="text-xs text-slate-500 font-medium">Verified Professionals</div>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-slate-900">24/7</div>
                                    <div class="text-xs text-slate-500 font-medium">Customer Support</div>
                                </div>
                                <div>
                                    <div class="text-2xl font-bold text-slate-900">4.9 ★</div>
                                    <div class="text-xs text-slate-500 font-medium">User Rating</div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Hero Column: App Preview Screenshots -->
                        <div class="lg:col-span-5 relative flex justify-center">
                            <!-- Background decoration blur -->
                            <div
                                class="absolute inset-0 bg-gradient-to-tr from-brand-500/20 to-teal-300/30 rounded-full filter blur-3xl -z-10 transform scale-110">
                            </div>

                            <!-- Mobile Mockup Container -->
                            <div
                                class="relative w-full max-w-[320px] bg-slate-900 rounded-[40px] p-3 shadow-2xl phone-frame border-4 border-slate-800">
                                <div class="bg-slate-50 rounded-[32px] overflow-hidden border border-slate-200">
                                    <!-- Mobile Status Bar Mock -->
                                    <div
                                        class="bg-white px-6 py-2 flex justify-between items-center text-[10px] font-bold text-slate-800 border-b border-slate-100">
                                        <span>4:21</span>
                                        <div class="flex items-center gap-1.5">
                                            <i class="fa-solid fa-signal"></i>
                                            <i class="fa-solid fa-wifi"></i>
                                            <i class="fa-solid fa-battery-full"></i>
                                        </div>
                                    </div>

                                    <!-- Mock UI Content reflecting App Screenshot 1 -->
                                    <div class="p-3 space-y-3 bg-slate-50 max-h-[580px] overflow-y-auto">
                                        <!-- Header inside App -->
                                        <div class="flex justify-between items-center">
                                            <div class="flex items-center gap-1.5">
                                                <div
                                                    class="w-6 h-6 bg-brand-500 rounded-full flex items-center justify-center text-white text-[10px]">
                                                    <i class="fa-solid fa-heart-pulse"></i>
                                                </div>
                                                <span class="font-extrabold text-xs text-slate-800">varasa</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <i class="fa-regular fa-bell text-xs text-slate-600"></i>
                                                <div class="w-6 h-6 rounded-full bg-slate-300 overflow-hidden">
                                                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80"
                                                        class="w-full h-full object-cover" alt="User">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Search & Location Bar -->
                                        <div class="flex gap-2 text-[10px]">
                                            <div
                                                class="bg-white p-2 rounded-xl shadow-sm flex items-center gap-1.5 flex-1 border border-slate-100">
                                                <i class="fa-solid fa-location-dot text-brand-500"></i>
                                                <div>
                                                    <div class="text-[8px] text-slate-400">Mirpur-1, Dhaka...</div>
                                                    <div class="font-bold text-slate-700">Mirpur-1 ▼</div>
                                                </div>
                                            </div>
                                            <div
                                                class="bg-white p-2 rounded-xl shadow-sm flex items-center justify-between w-28 border border-slate-100 text-slate-400">
                                                <span>Search here</span>
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </div>
                                        </div>

                                        <!-- Banner promo -->
                                        <div
                                            class="bg-gradient-to-r from-slate-900 to-slate-800 rounded-2xl p-3 text-white relative overflow-hidden shadow-md">
                                            <div class="text-[9px] uppercase text-emerald-400 font-bold tracking-wider">
                                                Special Offer!</div>
                                            <div class="text-sm font-extrabold mt-0.5">Get <span
                                                    class="text-brand-500">35% OFF</span></div>
                                            <div class="text-[8px] text-slate-300">On Your First Nurse Booking</div>
                                            <button
                                                class="mt-2 bg-brand-500 text-white text-[9px] font-bold px-2.5 py-1 rounded-lg">Check
                                                Now</button>
                                        </div>

                                        <!-- Services Grid Mock -->
                                        <div class="grid grid-cols-2 gap-2 text-left">
                                            <div class="bg-white p-2.5 rounded-xl shadow-sm border border-slate-100">
                                                <div class="font-bold text-[10px] text-slate-800 leading-tight">Nursing
                                                    Home Service</div>
                                                <div class="text-right mt-2 text-brand-500 text-lg"><i
                                                        class="fa-solid fa-user-nurse"></i></div>
                                            </div>
                                            <div class="bg-white p-2.5 rounded-xl shadow-sm border border-slate-100">
                                                <div class="font-bold text-[10px] text-slate-800 leading-tight">Nurse
                                                    Caregiver & Senior</div>
                                                <div class="text-right mt-2 text-brand-500 text-lg"><i
                                                        class="fa-solid fa-wheelchair"></i></div>
                                            </div>
                                            <div class="bg-white p-2.5 rounded-xl shadow-sm border border-slate-100">
                                                <div class="font-bold text-[10px] text-slate-800 leading-tight">
                                                    Physiotherapy Service</div>
                                                <div class="text-right mt-2 text-brand-500 text-lg"><i
                                                        class="fa-solid fa-child-reaching"></i></div>
                                            </div>
                                            <div class="bg-white p-2.5 rounded-xl shadow-sm border border-slate-100">
                                                <div class="font-bold text-[10px] text-slate-800 leading-tight">Home
                                                    Diagnostic Test</div>
                                                <div class="text-right mt-2 text-brand-500 text-lg"><i
                                                        class="fa-solid fa-vials"></i></div>
                                            </div>
                                        </div>

                                        <!-- Consultation Call Card -->
                                        <div
                                            class="bg-brand-500 text-white p-2.5 rounded-xl flex items-center justify-between text-[10px] font-bold shadow-md">
                                            <span>Get Free Consultation</span>
                                            <i class="fa-solid fa-phone-volume text-sm"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- Services Section -->
            <section id="services" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto space-y-4">
                    <h2 class="text-xs font-bold text-brand-600 uppercase tracking-widest">Our Offerings</h2>
                    <p class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">Comprehensive
                        Healthcare at Your Home</p>
                    <p class="text-slate-600 text-base">Select from our certified home medical care services tailored
                        for patients, seniors, and post-surgery recovery.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">

                    <!-- Service Card 1 -->
                    <div
                        class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-100 hover:shadow-2xl hover:shadow-brand-500/10 transition-all hover:-translate-y-1 group">
                        <div
                            class="w-14 h-14 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-brand-500 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-user-nurse"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mt-6">Nursing Home Service</h3>
                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">Daily, weekly, or monthly expert
                            certified medical assistant nurses for patient care, dressing, catheter, and IV medication.
                        </p>
                        <div
                            class="mt-6 flex items-center justify-between text-xs font-semibold text-brand-600 pt-4 border-t border-slate-100">
                            <span>Flexible Shift Booking</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Service Card 2 -->
                    <div
                        class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-100 hover:shadow-2xl hover:shadow-brand-500/10 transition-all hover:-translate-y-1 group">
                        <div
                            class="w-14 h-14 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-brand-500 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-hands-holding-child"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mt-6">Nurse Caregiver & Senior Care</h3>
                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">Dedicated elderly care, personal hygiene
                            support, companionship, and round-the-clock monitoring for your loved ones.</p>
                        <div
                            class="mt-6 flex items-center justify-between text-xs font-semibold text-brand-600 pt-4 border-t border-slate-100">
                            <span>Daily / 12h / 24h Options</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Service Card 3 -->
                    <div
                        class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-100 hover:shadow-2xl hover:shadow-brand-500/10 transition-all hover:-translate-y-1 group">
                        <div
                            class="w-14 h-14 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-brand-500 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-person-walking-rehabilitation"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mt-6">Physiotherapy Home Service</h3>
                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">Specialized physiotherapy sessions for
                            stroke recovery, paralysis, joint pain, and post-operation physical rehabilitation.</p>
                        <div
                            class="mt-6 flex items-center justify-between text-xs font-semibold text-brand-600 pt-4 border-t border-slate-100">
                            <span>Expert Physiotherapists</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Service Card 4 -->
                    <div
                        class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-100 hover:shadow-2xl hover:shadow-brand-500/10 transition-all hover:-translate-y-1 group">
                        <div
                            class="w-14 h-14 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-brand-500 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-vials"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mt-6">Home Diagnostic Test</h3>
                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">Hassle-free sample collection from your
                            home with lab test report updates delivered directly inside your mobile app.</p>
                        <div
                            class="mt-6 flex items-center justify-between text-xs font-semibold text-brand-600 pt-4 border-t border-slate-100">
                            <span>Digital Reports</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Service Card 5 -->
                    <div
                        class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-100 hover:shadow-2xl hover:shadow-brand-500/10 transition-all hover:-translate-y-1 group">
                        <div
                            class="w-14 h-14 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-brand-500 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-user-doctor"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mt-6">Doctor Video Consultation</h3>
                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">Connect instantly with verified MBBS
                            doctors for online prescriptions, follow-ups, and emergency health advice.</p>
                        <div
                            class="mt-6 flex items-center justify-between text-xs font-semibold text-brand-600 pt-4 border-t border-slate-100">
                            <span>Instant Video Call</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                    <!-- Service Card 6 -->
                    <div
                        class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl shadow-slate-100 hover:shadow-2xl hover:shadow-brand-500/10 transition-all hover:-translate-y-1 group">
                        <div
                            class="w-14 h-14 bg-brand-50 text-brand-600 rounded-2xl flex items-center justify-center text-2xl group-hover:bg-brand-500 group-hover:text-white transition-colors">
                            <i class="fa-solid fa-truck-medical"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mt-6">Medicine Home Delivery</h3>
                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">Upload prescription and get genuine
                            medicines delivered directly to your home with special discounts.</p>
                        <div
                            class="mt-6 flex items-center justify-between text-xs font-semibold text-brand-600 pt-4 border-t border-slate-100">
                            <span>Fast Doorstep Delivery</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>

                </div>
            </section>

            <!-- Dual App Experience Section -->
            <section id="dual-app" class="bg-slate-900 text-white py-20 relative overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                    <div class="text-center max-w-3xl mx-auto space-y-4">
                        <div
                            class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-500/20 text-brand-400 text-xs font-bold border border-brand-500/30 uppercase">
                            Built For Everyone
                        </div>
                        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Two Tailored Experiences in One
                            Platform</h2>
                        <p class="text-slate-400">Whether you are seeking home health care or providing professional
                            nursing services, Varasa simplifies everything.</p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mt-16">

                        <!-- User App Experience Card -->
                        <div
                            class="bg-slate-800/80 rounded-3xl p-8 border border-slate-700/80 hover:border-brand-500/50 transition-all space-y-6">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 bg-brand-500/20 rounded-2xl flex items-center justify-center text-brand-400 text-xl font-bold">
                                    <i class="fa-solid fa-hospital-user"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-white">For Patients & Families</h3>
                                    <p class="text-xs text-slate-400">Book and manage healthcare with total peace of
                                        mind</p>
                                </div>
                            </div>

                            <ul class="space-y-4 text-slate-300 text-sm">
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-check text-brand-400 mt-1"></i>
                                    <span><strong>Transparent Pricing:</strong> Choose Daily (8h/12h/24h), Weekly (5,000
                                        BDT+), or Monthly plans without hidden fees.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-check text-brand-400 mt-1"></i>
                                    <span><strong>Verified Nurse Assistant Profile:</strong> View ratings (5.0★), order
                                        history, and certifications before booking.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-check text-brand-400 mt-1"></i>
                                    <span><strong>Order Tracking:</strong> Monitor shift status, caregiver location, and
                                        care schedules directly from home.</span>
                                </li>
                            </ul>

                            <div class="pt-4 border-t border-slate-700/60">
                                <a href="#download"
                                    class="inline-flex items-center gap-2 text-brand-400 hover:text-brand-300 text-sm font-bold">
                                    Explore Patient Features <i class="fa-solid fa-chevron-right text-xs"></i>
                                </a>
                            </div>
                        </div>

                        <!-- Professional / Caregiver App Experience Card -->
                        <div id="caregiver"
                            class="bg-slate-800/80 rounded-3xl p-8 border border-slate-700/80 hover:border-brand-500/50 transition-all space-y-6">
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-12 h-12 bg-emerald-500/20 rounded-2xl flex items-center justify-center text-emerald-400 text-xl font-bold">
                                    <i class="fa-solid fa-user-doctor"></i>
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-white">For Nurses & Caregivers</h3>
                                    <p class="text-xs text-slate-400">Earn flexible income with verified patient
                                        requests</p>
                                </div>
                            </div>

                            <ul class="space-y-4 text-slate-300 text-sm">
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-check text-emerald-400 mt-1"></i>
                                    <span><strong>Instant Request Alerts:</strong> Accept or reject incoming service
                                        orders with full address, time, gender preference, and service fee
                                        details.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-check text-emerald-400 mt-1"></i>
                                    <span><strong>Verification & Approval:</strong> Secure document submission and
                                        status updates (Pending/Approved) for quick onboarding.</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-circle-check text-emerald-400 mt-1"></i>
                                    <span><strong>Earnings Dashboard:</strong> Track completed shifts, manage schedules,
                                        and request transparent withdrawals.</span>
                                </li>
                            </ul>

                            <div class="pt-4 border-t border-slate-700/60">
                                <a href="#download"
                                    class="inline-flex items-center gap-2 text-emerald-400 hover:text-emerald-300 text-sm font-bold">
                                    Join as Healthcare Professional <i class="fa-solid fa-chevron-right text-xs"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- App Download Banner CTA -->
            <section id="download" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div
                    class="bg-gradient-to-r from-brand-500 to-teal-700 rounded-3xl p-8 sm:p-14 text-white flex flex-col lg:flex-row items-center justify-between gap-8 shadow-2xl shadow-brand-500/20 relative overflow-hidden">
                    <div class="space-y-4 text-center lg:text-left max-w-xl">
                        <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Ready to Get Professional Health
                            Service at Home?</h2>
                        <p class="text-emerald-100 text-sm sm:text-base">Download the Varasa Health Home Service App
                            today on Android & iOS. Fast, safe, and reliable home care.</p>
                    </div>

                    <div class="flex flex-wrap gap-4 justify-center">
                        <button
                            class="flex items-center gap-3 bg-slate-900 hover:bg-slate-800 text-white px-6 py-3.5 rounded-2xl shadow-xl transition-all hover:scale-105">
                            <i class="fa-brands fa-google-play text-2xl text-brand-500"></i>
                            <div class="text-left">
                                <div class="text-[10px] uppercase text-slate-400">Download for</div>
                                <div class="text-sm font-bold">Android Device</div>
                            </div>
                        </button>
                        <button
                            class="flex items-center gap-3 bg-white text-slate-900 hover:bg-slate-100 px-6 py-3.5 rounded-2xl shadow-xl transition-all hover:scale-105">
                            <i class="fa-brands fa-apple text-2xl text-brand-600"></i>
                            <div class="text-left">
                                <div class="text-[10px] uppercase text-slate-500">Download for</div>
                                <div class="text-sm font-bold">iOS iPhone</div>
                            </div>
                        </button>
                    </div>
                </div>
            </section>

        </div>


        <!-- ================= ACCOUNT DELETION PAGE SECTION ================= -->
        <div id="delete-account-view" class="hidden max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

            <!-- Breadcrumb Navigation -->
            <div class="flex items-center gap-2 text-xs font-medium text-slate-500">
                <button onclick="switchView('landing')" class="hover:text-brand-600">Home</button>
                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                <span class="text-slate-900">Account Deletion Request</span>
            </div>

            <!-- Page Header -->
            <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-xl space-y-4">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-50 border border-rose-200 text-rose-700 text-xs font-bold">
                    <i class="fa-solid fa-shield-halved"></i> Google Play Data Safety Compliant
                </div>
                <h1 class="text-3xl font-extrabold text-slate-900">Request Account & Data Deletion</h1>
                <p class="text-slate-600 text-sm leading-relaxed">
                    According to Google Play User Data Policies, you have the right to request the permanent removal of
                    your <strong>Varasa Health Home Service</strong> account and all associated personal data without
                    needing to reinstall the mobile application.
                </p>
            </div>

            <!-- Deletion Form Card -->
            <div class="bg-white rounded-3xl p-8 sm:p-10 border border-slate-100 shadow-xl space-y-6">

                <form id="deletion-form" onsubmit="handleAccountDeletionSubmit(event)" class="space-y-6">

                    <!-- Account Type Selection -->
                    <div>
                        <label class="block text-sm font-bold text-slate-800 mb-2">Select Your Account Type <span
                                class="text-rose-500">*</span></label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <label
                                class="relative flex items-center p-4 rounded-2xl border-2 border-slate-100 cursor-pointer hover:border-brand-500 has-[:checked]:border-brand-500 has-[:checked]:bg-brand-50/50 transition-all">
                                <input type="radio" name="account_type" value="Patient/User" checked
                                    class="text-brand-500 focus:ring-brand-500">
                                <div class="ml-3">
                                    <div class="font-bold text-sm text-slate-900">Patient / Service User</div>
                                    <div class="text-xs text-slate-500">Booked nursing services or tests</div>
                                </div>
                            </label>
                            <label
                                class="relative flex items-center p-4 rounded-2xl border-2 border-slate-100 cursor-pointer hover:border-brand-500 has-[:checked]:border-brand-500 has-[:checked]:bg-brand-50/50 transition-all">
                                <input type="radio" name="account_type" value="Professional/Caregiver"
                                    class="text-brand-500 focus:ring-brand-500">
                                <div class="ml-3">
                                    <div class="font-bold text-sm text-slate-900">Healthcare Professional</div>
                                    <div class="text-xs text-slate-500">Registered nurse or caregiver</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Input Fields Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-bold text-slate-800 mb-2">Full Name <span
                                    class="text-rose-500">*</span></label>
                            <input type="text" required placeholder="e.g. Tanvir Ahmed"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-800 mb-2">Registered Mobile Number / Email
                                <span class="text-rose-500">*</span></label>
                            <input type="text" required placeholder="e.g. +8801700000000 or user@mail.com"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 text-sm">
                        </div>

                    </div>

                    <!-- User ID (Optional) -->
                    <div>
                        <label class="block text-sm font-bold text-slate-800 mb-1">User ID / Caregiver ID
                            (Optional)</label>
                        <p class="text-xs text-slate-400 mb-2">As shown in your profile tab inside the Varasa app (e.g.
                            User ID: D0003)</p>
                        <input type="text" placeholder="e.g. D0003"
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 focus:ring-2 focus:ring-brand-500/20 text-sm">
                    </div>

                    <!-- Deletion Reason -->
                    <div>
                        <label class="block text-sm font-bold text-slate-800 mb-2">Reason for Account Deletion
                            (Optional)</label>
                        <select
                            class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-brand-500 text-sm bg-white">
                            <option value="">-- Select Reason --</option>
                            <option>No longer need home care services</option>
                            <option>Created a duplicate account</option>
                            <option>Privacy concerns</option>
                            <option>App experience issue</option>
                            <option>Other</option>
                        </select>
                    </div>

                    <!-- Checkbox Acknowledgment -->
                    <div class="p-4 bg-amber-50 rounded-2xl border border-amber-200 space-y-3">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" required class="mt-1 rounded text-brand-500 focus:ring-brand-500">
                            <span class="text-xs text-amber-900 leading-relaxed font-medium">
                                I understand that deleting my account will permanently erase my personal profile,
                                booking histories, address records, and app preferences. This action cannot be undone.
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" id="delete-submit-btn"
                        class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-rose-600/25 transition-all text-sm flex items-center justify-center gap-2">
                        <i class="fa-solid fa-trash-can"></i> Submit Account Deletion Request
                    </button>

                </form>

            </div>

            <!-- Data Retention & Privacy Policy Section -->
            <div class="bg-slate-100 rounded-3xl p-8 space-y-4 text-xs text-slate-600 border border-slate-200">
                <h3 class="font-bold text-slate-900 text-sm">Data Retention & Deletion Timeline Information:</h3>
                <ul class="list-disc pl-5 space-y-2 leading-relaxed">
                    <li><strong>Processing Time:</strong> Account deletion requests are typically verified and processed
                        within <strong>7 business days</strong>.</li>
                    <li><strong>Data Erased:</strong> Full name, phone number, saved delivery addresses, profile photo,
                        and active booking schedules.</li>
                    <li><strong>Legal & Financial Retention:</strong> Completed transaction records and invoices may be
                        retained securely for up to 90 days strictly for legal audit and tax compliance required under
                        local regulatory laws.</li>
                </ul>
            </div>

        </div>

    </main>

    <!-- SUCCESS CONFIRMATION MODAL -->
    <div id="success-modal"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center hidden p-4">
        <div class="bg-white rounded-3xl p-8 max-w-md w-full text-center space-y-6 shadow-2xl animate-fade-in">
            <div
                class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-3xl mx-auto">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="space-y-2">
                <h3 class="text-2xl font-bold text-slate-900">Request Submitted!</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Your request for account deletion has been received. Our support team will verify your registered
                    information and process your request within 7 business days.
                </p>
            </div>
            <div class="p-3 bg-slate-50 rounded-xl text-xs text-slate-500 font-mono">
                Request ID: <span id="request-id-display">VR-89210</span>
            </div>
            <button onclick="closeModal()"
                class="w-full bg-brand-500 hover:bg-brand-600 text-white font-bold py-3.5 rounded-xl transition-all text-sm">
                Return to Home
            </button>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-16 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                <!-- Brand Info -->
                <div class="space-y-4 md:col-span-1">
                    <div class="flex items-center gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-brand-500 flex items-center justify-center text-white font-bold">
                            <i class="fa-solid fa-heart-pulse"></i>
                        </div>
                        <span class="text-xl font-bold text-white tracking-tight">varasa</span>
                    </div>
                    <p class="text-xs leading-relaxed text-slate-400">
                        Varasa Health Home Service provides certified nursing home care, elderly caregivers,
                        physiotherapy, and lab tests right to your residence.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="text-white text-sm font-bold mb-4">Services</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#services" onclick="switchView('landing')"
                                class="hover:text-white transition-colors">Nursing Home Service</a></li>
                        <li><a href="#services" onclick="switchView('landing')"
                                class="hover:text-white transition-colors">Senior & Caregiver Care</a></li>
                        <li><a href="#services" onclick="switchView('landing')"
                                class="hover:text-white transition-colors">Physiotherapy at Home</a></li>
                        <li><a href="#services" onclick="switchView('landing')"
                                class="hover:text-white transition-colors">Home Diagnostic Tests</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h4 class="text-white text-sm font-bold mb-4">Contact Office</h4>
                    <ul class="space-y-2 text-xs">
                        <li class="flex items-center gap-2"><i class="fa-solid fa-location-dot text-brand-500"></i>
                            House 57, Road 25, Block A, Banani, Dhaka</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-phone text-brand-500"></i>
                            01859382953, 01859382253</li>
                        <li class="flex items-center gap-2"><i class="fa-solid fa-envelope text-brand-500"></i>
                            support@varasahealth.com</li>
                    </ul>
                </div>

                <!-- Google Play Compliance Link -->
                <div>
                    <h4 class="text-white text-sm font-bold mb-4">Data Policy & Compliance</h4>
                    <p class="text-xs text-slate-400 mb-3">Google Play Data Safety & User Privacy links:</p>
                    <button onclick="switchView('delete-account')"
                        class="inline-flex items-center gap-2 text-xs text-rose-400 hover:text-rose-300 font-semibold bg-rose-950/50 border border-rose-900 px-3 py-2 rounded-xl transition-all">
                        <i class="fa-solid fa-user-xmark"></i> Delete Account Request URL
                    </button>
                </div>

            </div>

            <div
                class="mt-12 pt-8 border-t border-slate-800 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 gap-4">
                <p>&copy; 2026 Varasa Health Home Service. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-slate-300">Privacy Policy</a>
                    <a href="#" class="hover:text-slate-300">Terms of Service</a>
                    <a href="#" onclick="switchView('delete-account')" class="hover:text-slate-300">Data Deletion</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Inline View Switcher & Logic Scripts -->
    <script>
        // Switch between Landing View and Account Deletion View
        function switchView(viewName) {
            const landingView = document.getElementById('landing-view');
            const deleteView = document.getElementById('delete-account-view');

            if (viewName === 'delete-account') {
                landingView.classList.add('hidden');
                deleteView.classList.remove('hidden');
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                deleteView.classList.add('hidden');
                landingView.classList.remove('hidden');
            }
        }

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        function closeMobileMenu() {
            mobileMenu.classList.add('hidden');
        }

        // Handle Account Deletion Submission
        function handleAccountDeletionSubmit(e) {
            e.preventDefault();
            
            const submitBtn = document.getElementById('delete-submit-btn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner animate-spin"></i> Processing...';

            setTimeout(() => {
                // Generate random Request ID
                const randomId = 'VR-' + Math.floor(10000 + Math.random() * 90000);
                document.getElementById('request-id-display').textContent = randomId;

                // Show Modal
                document.getElementById('success-modal').classList.remove('hidden');

                // Reset Form & Button
                document.getElementById('deletion-form').reset();
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<i class="fa-solid fa-trash-can"></i> Submit Account Deletion Request';
            }, 1200);
        }

        function closeModal() {
            document.getElementById('success-modal').classList.add('hidden');
            switchView('landing');
        }

        // Check URL hash on page load for direct link access (#delete-account)
        window.addEventListener('load', () => {
            if (window.location.hash === '#delete-account') {
                switchView('delete-account');
            }
        });
    </script>
</body>

</html>