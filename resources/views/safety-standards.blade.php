@extends('layouts.frontend')

@section('title', 'Clinical Safety Standards & Staff Vetting - Varasa Health')
@section('meta_description', 'Learn about Varasa Health staff vetting and safety standards: 4-point credential screening, NID and police checks, BNC nursing certification, and in-house doctor supervision.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Clinical Safety & Staff Vetting Standards</h1>
        <p class="text-slate-600 text-xs sm:text-sm mt-1">Multi-layered credential screening, police checks, nursing council registration, and direct physician oversight.</p>
    </div>

    <!-- 4-POINT VERIFICATION FRAMEWORK -->
    <div class="space-y-8">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold text-brand-600 uppercase tracking-widest bg-brand-50 border border-brand-200 px-2.5 py-1 rounded">
                Verification Pipeline
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                Our Mandatory 4-Point Screening Process
            </h2>
            <p class="text-xs sm:text-sm text-slate-500">
                Only ~18% of caregiver and nurse applicants pass Varasa's background checks and clinical competency examinations.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Pillar 1 -->
            <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded bg-slate-100 text-slate-800 flex items-center justify-center text-xl border border-slate-200">
                        <i class="fa-solid fa-id-card-clip"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-500">Pillar 1</span>
                        <h3 class="text-base sm:text-lg font-bold text-slate-900">National NID & Police Record Screening</h3>
                    </div>
                </div>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Every candidate submits their government National ID, biometric data verification, and permanent residence address verification. We screen applicants against local police records to ensure no history of criminal or civil misconduct.
                </p>
                <ul class="space-y-1.5 text-xs text-slate-600 border-t border-slate-100 pt-3">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-600"></i> Smart National NID verification via election commission database</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-600"></i> Physical verification of permanent village and current Dhaka residences</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-600"></i> Two verified family guarantor signatures with national IDs</li>
                </ul>
            </div>

            <!-- Pillar 2 -->
            <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded bg-brand-50 text-brand-600 flex items-center justify-center text-xl border border-brand-200">
                        <i class="fa-solid fa-certificate"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-brand-600">Pillar 2</span>
                        <h3 class="text-base sm:text-lg font-bold text-slate-900">BNC Accreditation & Clinical Verification</h3>
                    </div>
                </div>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    For all nursing positions, we validate certifications with the Bangladesh Nursing & Midwifery Council (BNC). Medical assistant and caregiver candidates must hold accredited certifications from recognized healthcare training institutes.
                </p>
                <ul class="space-y-1.5 text-xs text-slate-600 border-t border-slate-100 pt-3">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-600"></i> Direct verification of B.Sc or Diploma Nursing registration numbers</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-600"></i> Minimum 1-2 years prior clinical hospital or ward experience</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-600"></i> Reference verification with previous supervising medical doctors</li>
                </ul>
            </div>

            <!-- Pillar 3 -->
            <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded bg-teal-50 text-teal-600 flex items-center justify-center text-xl border border-teal-200">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-teal-600">Pillar 3</span>
                        <h3 class="text-base sm:text-lg font-bold text-slate-900">Physician Tele-Supervision & Escalation</h3>
                    </div>
                </div>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Home care personnel are never isolated. Our in-house medical doctors remain available 24/7 to review patient parameter logs, offer protocol advice, and handle clinical escalations when patient vitals change.
                </p>
                <ul class="space-y-1.5 text-xs text-slate-600 border-t border-slate-100 pt-3">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-600"></i> Daily vitals charting (BP, Pulse, SpO2, Blood Sugar, Temperature)</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-600"></i> Direct tele-consultation channel between home nurse and medical desk</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-600"></i> Rapid coordination with family treating physician for dosage updates</li>
                </ul>
            </div>

            <!-- Pillar 4 -->
            <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded bg-cyan-50 text-cyan-600 flex items-center justify-center text-xl border border-cyan-200">
                        <i class="fa-solid fa-rotate"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-cyan-600">Pillar 4</span>
                        <h3 class="text-base sm:text-lg font-bold text-slate-900">Guaranteed Replacement & Safety Net</h3>
                    </div>
                </div>
                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Patient compatibility and comfort are paramount. If at any time you feel the assigned caregiver or nurse is not the right fit for your family, we provide a replacement within 24 hours at zero additional cost.
                </p>
                <ul class="space-y-1.5 text-xs text-slate-600 border-t border-slate-100 pt-3">
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-600"></i> Dedicated on-call reserve pool maintained across Dhaka Metro</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-600"></i> Automatic backup dispatched if assigned personnel falls ill</li>
                    <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-600"></i> 100% money-back pro-rata policy on unfulfilled shift commitments</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- INFECTION CONTROL & CLINICAL PROTOCOLS -->
    <div class="bg-white rounded-lg p-6 sm:p-10 border border-slate-200 shadow-sm space-y-6">
        <h3 class="text-xl font-bold text-slate-900">Hospital-Grade Hygiene & Infection Control</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs sm:text-sm text-slate-600">
            <div class="p-4 bg-slate-50 rounded border border-slate-200 space-y-2">
                <div class="font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-hands-bubbles text-brand-600"></i> Sterile Aseptic Techniques
                </div>
                <p class="leading-relaxed">
                    All invasive procedures (IV cannulation, Foley catheter replacement, surgical wound dressings) are performed using sterile gloves, sealed disposable kits, and hospital-grade antiseptics.
                </p>
            </div>
            <div class="p-4 bg-slate-50 rounded border border-slate-200 space-y-2">
                <div class="font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-shield-virus text-brand-600"></i> Health Screening for Staff
                </div>
                <p class="leading-relaxed">
                    Our active healthcare personnel undergo periodic health check-ups and infectious disease screenings to safeguard immunocompromised and senior patients at home.
                </p>
            </div>
            <div class="p-4 bg-slate-50 rounded border border-slate-200 space-y-2">
                <div class="font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-temperature-arrow-down text-brand-600"></i> Cold-Chain Pathology Transport
                </div>
                <p class="leading-relaxed">
                    All home diagnostic blood and urine samples are collected in sterile vacuum tubes and transported in temperature-monitored cooler boxes to accredited pathology laboratories.
                </p>
            </div>
        </div>
    </div>

    <!-- Contact & Assistance Card -->
    <div class="bg-slate-900 text-white rounded-lg p-6 sm:p-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
        <div>
            <div class="inline-flex items-center gap-2 text-xs font-bold text-brand-400 uppercase tracking-wider mb-2">
                <i class="fa-solid fa-headset"></i> Immediate Dispatch Available
            </div>
            <h3 class="text-xl sm:text-2xl font-bold tracking-tight">Need a Triple-Screened Nurse or Caregiver?</h3>
            <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-xl">
                Our care coordinators are standing by 24/7 across Dhaka Metro to match verified staff to your family.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="inline-flex items-center gap-2 bg-white hover:bg-slate-100 text-slate-900 text-xs font-bold px-4 py-2.5 rounded transition-colors">
                <i class="fa-solid fa-phone"></i> {{ $helplineNumber }}
            </a>
            <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($whatsappMessage) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded transition-colors">
                <i class="fa-brands fa-whatsapp text-sm"></i> WhatsApp Us
            </a>
        </div>
    </div>

</div>
@endsection
