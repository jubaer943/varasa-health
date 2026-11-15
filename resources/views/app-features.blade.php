@extends('layouts.frontend')

@section('title', 'Varasa Mobile Apps - Patient & Healthcare Professional Platforms')
@section('meta_description', 'Discover Varasa Health mobile applications: Track live caregiver shifts and verified nurses for families, and manage flexible hospital-grade home shifts for healthcare staff.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Varasa Mobile Applications</h1>
        <p class="text-slate-600 text-xs sm:text-sm mt-1">Connected mobile technology built for patient families and verified healthcare professionals.</p>
    </div>

    <!-- DUAL APP ARCHITECTURE -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        
        <!-- App 1: Patient & Family Platform -->
        <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6 flex flex-col justify-between">
            <div class="space-y-5">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded bg-brand-600 text-white flex items-center justify-center text-xl shadow-sm">
                        <i class="fa-solid fa-hospital-user"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-brand-700 bg-brand-50 px-2 py-0.5 rounded border border-brand-200">Patient & Family</span>
                        <h3 class="text-xl font-bold text-slate-900 mt-0.5">Varasa Patient App</h3>
                    </div>
                </div>

                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Total reassurance for family members monitoring the medical routine, vital parameters, and daily care of elderly or recovering loved ones.
                </p>

                <div class="space-y-3.5 border-t border-slate-100 pt-4 text-xs sm:text-sm text-slate-700">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded bg-brand-50 text-brand-600 flex items-center justify-center text-xs shrink-0 mt-0.5 font-bold">1</div>
                        <div>
                            <strong>Nurse Credential Validation:</strong>
                            <p class="text-slate-500 text-xs mt-0.5">View verified BNC certificates, past shift counts, clinical specializations, and patient reviews before shift starts.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded bg-brand-50 text-brand-600 flex items-center justify-center text-xs shrink-0 mt-0.5 font-bold">2</div>
                        <div>
                            <strong>Live Shift Logging & Daily Vitals:</strong>
                            <p class="text-slate-500 text-xs mt-0.5">Monitor caregiver clock-in/out in real-time, charted blood pressure, pulse, SpO2, and medications given.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded bg-brand-50 text-brand-600 flex items-center justify-center text-xs shrink-0 mt-0.5 font-bold">3</div>
                        <div>
                            <strong>Secure Lab Reports & Invoices Vault:</strong>
                            <p class="text-slate-500 text-xs mt-0.5">Store historical diagnostic PDF test reports, doctor prescriptions, and official payment receipts securely.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded bg-brand-50 text-brand-600 flex items-center justify-center text-xs shrink-0 mt-0.5 font-bold">4</div>
                        <div>
                            <strong>Instant Emergency Escalation:</strong>
                            <p class="text-slate-500 text-xs mt-0.5">Direct 1-tap call to our 24/7 care coordination desk and on-call supervising doctor for vital emergencies.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex flex-wrap items-center gap-3">
                @if(!empty($androidUrl))
                    <a href="{{ $androidUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-4 py-2.5 rounded transition-all">
                        <i class="fa-brands fa-google-play text-brand-400"></i> Google Play
                    </a>
                @endif
                @if(!empty($iosUrl))
                    <a href="{{ $iosUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-4 py-2.5 rounded transition-all">
                        <i class="fa-brands fa-apple text-white"></i> App Store
                    </a>
                @endif
                <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="inline-flex items-center gap-1.5 text-brand-600 hover:text-brand-700 text-xs font-bold py-2">
                    <span>Or Book via Helpline</span> <i class="fa-solid fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        <!-- App 2: Healthcare Professional Platform -->
        <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm space-y-6 flex flex-col justify-between">
            <div class="space-y-5">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded bg-slate-900 text-emerald-400 flex items-center justify-center text-xl shadow-sm">
                        <i class="fa-solid fa-user-nurse"></i>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-800 bg-emerald-50 px-2 py-0.5 rounded border border-emerald-200">Healthcare Staff</span>
                        <h3 class="text-xl font-bold text-slate-900 mt-0.5">Varasa Professional App</h3>
                    </div>
                </div>

                <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                    Empowering nurses and caregivers with dignified clinical income, schedule autonomy, safety protections, and direct doctor guidance.
                </p>

                <div class="space-y-3.5 border-t border-slate-100 pt-4 text-xs sm:text-sm text-slate-700">
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs shrink-0 mt-0.5 font-bold">1</div>
                        <div>
                            <strong>Autonomous Shift Selection:</strong>
                            <p class="text-slate-500 text-xs mt-0.5">Choose shift timings (8h, 12h, or 24h) and preferred geographical zones in Dhaka with total schedule freedom.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs shrink-0 mt-0.5 font-bold">2</div>
                        <div>
                            <strong>Weekly Transparent Mobile Payouts:</strong>
                            <p class="text-slate-500 text-xs mt-0.5">Track completed shifts, client ratings, and withdraw earnings directly via bKash, Nagad, or bank accounts.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs shrink-0 mt-0.5 font-bold">3</div>
                        <div>
                            <strong>Verified Patient Locations & Staff Safety:</strong>
                            <p class="text-slate-500 text-xs mt-0.5">All patient homes are verified by Varasa coordinators before assignment to ensure professional safety and dignity.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-6 h-6 rounded bg-emerald-50 text-emerald-600 flex items-center justify-center text-xs shrink-0 mt-0.5 font-bold">4</div>
                        <div>
                            <strong>Digital Care Protocol Guidelines:</strong>
                            <p class="text-slate-500 text-xs mt-0.5">Access standardized patient charting workflows and direct doctor consultation support during complex cases.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t border-slate-100 flex flex-wrap items-center gap-3">
                @if(!empty($androidUrl))
                    <a href="{{ $androidUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded transition-all">
                        <i class="fa-brands fa-google-play"></i> Staff App (Google Play)
                    </a>
                @endif
                <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 text-slate-700 hover:text-slate-900 text-xs font-bold py-2">
                    <i class="fa-solid fa-lock text-[10px]"></i> Staff Web Portal
                </a>
            </div>
        </div>

    </div>

    <!-- DATA SECURITY & PRIVACY HIGHLIGHTS -->
    <div class="bg-white rounded-lg p-6 sm:p-10 border border-slate-200 shadow-sm space-y-6">
        <h3 class="text-xl font-bold text-slate-900">Enterprise Security & Patient Data Protection</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-xs sm:text-sm text-slate-600">
            <div class="p-4 bg-slate-50 rounded border border-slate-200 space-y-2">
                <div class="font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-lock text-brand-600"></i> End-to-End Encryption
                </div>
                <p class="leading-relaxed">
                    All medical data, patient logs, and communication channels are protected with TLS 1.3 encryption. Patient records are strictly accessible only to assigned coordinators.
                </p>
            </div>
            <div class="p-4 bg-slate-50 rounded border border-slate-200 space-y-2">
                <div class="font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-shield-halved text-brand-600"></i> Google Play Data Safety
                </div>
                <p class="leading-relaxed">
                    Our platform fully complies with Google Play Console User Data Safety requirements with a dedicated public <a href="{{ route('delete-account') }}" class="text-brand-600 font-bold underline">Data Deletion Portal</a>.
                </p>
            </div>
            <div class="p-4 bg-slate-50 rounded border border-slate-200 space-y-2">
                <div class="font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-user-secret text-brand-600"></i> Zero Third-Party Sharing
                </div>
                <p class="leading-relaxed">
                    Patient medical conditions, home addresses, and phone numbers are never monetized or shared with third-party advertising brokers.
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
            <h3 class="text-xl sm:text-2xl font-bold tracking-tight">Need Assistance with the Mobile App?</h3>
            <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-xl">
                Our care coordinators can guide you through booking staff, downloading the app, or answering technical questions.
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
