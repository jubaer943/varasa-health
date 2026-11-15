@extends('layouts.frontend')

@section('title', 'About Us - Varasa Health Home Service')
@section('meta_description', 'Learn about Varasa Health Home Service - certified home nursing care, senior patient caregivers, home physiotherapy, and doorstep diagnostic blood tests across Dhaka Metro.')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">About Varasa Health</h1>
        <p class="text-slate-600 text-xs sm:text-sm mt-1 max-w-3xl">Dhaka's trusted provider of hospital-grade home healthcare, certified nurses, senior caregivers, and doorstep diagnostic support.</p>
    </div>

    <!-- Stats Bar -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm text-center space-y-1">
            <div class="text-2xl sm:text-3xl font-black text-brand-600">24/7</div>
            <div class="text-xs font-bold text-slate-800 uppercase tracking-wide">Care Helpline</div>
            <div class="text-[11px] text-slate-500">Uninterrupted dispatch across Dhaka</div>
        </div>
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm text-center space-y-1">
            <div class="text-2xl sm:text-3xl font-black text-brand-600">100%</div>
            <div class="text-xs font-bold text-slate-800 uppercase tracking-wide">Verified Personnel</div>
            <div class="text-[11px] text-slate-500">NID, police & credential audited</div>
        </div>
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm text-center space-y-1">
            <div class="text-2xl sm:text-3xl font-black text-brand-600">12 & 24h</div>
            <div class="text-xs font-bold text-slate-800 uppercase tracking-wide">Flexible Shifts</div>
            <div class="text-[11px] text-slate-500">Day, night or live-in rotations</div>
        </div>
        <div class="bg-white p-5 rounded-lg border border-slate-200 shadow-sm text-center space-y-1">
            <div class="text-2xl sm:text-3xl font-black text-brand-600">ISO/DGHS</div>
            <div class="text-xs font-bold text-slate-800 uppercase tracking-wide">Sterile Protocols</div>
            <div class="text-[11px] text-slate-500">Clinical infection control standard</div>
        </div>
    </div>

    <!-- CMS Content (if available from database) -->
    @if(!empty($about) && !empty($about->about_description))
        <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                <i class="fa-solid fa-hospital-user text-brand-600"></i> Corporate Profile & Mission
            </h2>
            <div class="prose prose-sm max-w-none text-xs sm:text-sm text-slate-700 leading-relaxed space-y-4">
                {!! $about->about_description !!}
            </div>
        </div>
    @endif

    <!-- Our Core Pillars -->
    <div class="space-y-4">
        <h2 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
            Our Healthcare Commitments
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Pillar 1 -->
            <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-md bg-brand-50 text-brand-600 flex items-center justify-center text-lg border border-brand-200">
                    <i class="fa-solid fa-user-nurse"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900">Certified Clinical Nursing</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Our registered nurses handle tracheostomy care, IV cannula infusions, wound dressing, Foley catheter changes, and continuous vital monitoring under doctor prescription.
                </p>
            </div>

            <!-- Pillar 2 -->
            <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-md bg-brand-50 text-brand-600 flex items-center justify-center text-lg border border-brand-200">
                    <i class="fa-solid fa-heart-pulse"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900">Compassionate Senior Care</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Trained caregivers assist bedridden or elderly family members with hygiene, medication reminders, feeding assistance, wheelchair mobility, and companionship.
                </p>
            </div>

            <!-- Pillar 3 -->
            <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm space-y-3">
                <div class="w-10 h-10 rounded-md bg-brand-50 text-brand-600 flex items-center justify-center text-lg border border-brand-200">
                    <i class="fa-solid fa-vial-circle-check"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900">Doorstep Diagnostics</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Trained medical technologists visit your residence at scheduled dawn or daytime hours with sterile vacutainer equipment, safely delivering specimens to accredited pathology labs.
                </p>
            </div>

        </div>
    </div>

    <!-- Safety & Verification Protocols Card -->
    <div class="bg-slate-900 text-white rounded-lg p-6 sm:p-8 space-y-4">
        <div class="flex items-center gap-2 text-xs font-bold text-brand-400 uppercase tracking-wider">
            <i class="fa-solid fa-shield-halved"></i> Patient Safety & Verification Guarantee
        </div>
        <h3 class="text-xl sm:text-2xl font-bold tracking-tight">
            How We Ensure Family Security & Peace of Mind
        </h3>
        <p class="text-xs sm:text-sm text-slate-300 leading-relaxed">
            Placing a caregiver inside your private home requires deep trust. That is why every Varasa Health nurse and attendant undergoes comprehensive multi-step background screening:
        </p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-2 text-xs text-slate-300">
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-emerald-400 text-sm"></i>
                <span>National ID Card & biometric verification</span>
            </div>
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-emerald-400 text-sm"></i>
                <span>Police clearance certificate & residential address check</span>
            </div>
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-emerald-400 text-sm"></i>
                <span>Nursing diploma & clinical competency validation</span>
            </div>
            <div class="flex items-center gap-2.5">
                <i class="fa-solid fa-circle-check text-emerald-400 text-sm"></i>
                <span>Strict Non-Disclosure & medical confidentiality agreements</span>
            </div>
        </div>
    </div>

    <!-- Need Care Contact Box -->
    <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
        <div>
            <h4 class="text-sm sm:text-base font-bold text-slate-900">Need Immediate Healthcare or Caregiver Support?</h4>
            <p class="text-xs text-slate-500 mt-1">Our care coordinators are ready to match your patient with certified staff today.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-4 py-2.5 rounded transition-colors">
                <i class="fa-solid fa-phone"></i> {{ $helplineNumber }}
            </a>
            <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($whatsappMessage) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded transition-colors">
                <i class="fa-brands fa-whatsapp"></i> WhatsApp Us
            </a>
        </div>
    </div>

</div>
@endsection
