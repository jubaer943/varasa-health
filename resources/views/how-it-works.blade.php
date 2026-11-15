@extends('layouts.frontend')

@section('title', 'How It Works - Varasa Health Home Care Workflow')
@section('meta_description', 'Learn how Varasa Health coordinates hospital-grade home care across Dhaka in 3 easy steps: plan selection, certified personnel matching, and physician-supervised home deployment.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">How It Works</h1>
        <p class="text-slate-600 text-xs sm:text-sm mt-1">Healthcare at home in 3 clear steps: fast, verified, and clinically supervised.</p>
    </div>

    <!-- 3-STEP PROCESS GRID -->
    <div class="space-y-8">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <span class="text-xs font-bold text-brand-600 uppercase tracking-widest bg-brand-50 border border-brand-200 px-2.5 py-1 rounded">
                Deployment Protocol
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                How Your Home Care Request is Fulfilled
            </h2>
            <p class="text-xs sm:text-sm text-slate-500">
                Transparent and verified coordination for complete family peace of mind.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Step 1 -->
            <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4 hover:border-brand-500 transition-all flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded bg-brand-50 text-brand-600 flex items-center justify-center text-lg font-black border border-brand-200">
                            01
                        </div>
                        <span class="text-[10px] font-bold text-brand-700 bg-slate-100 px-2.5 py-1 rounded uppercase tracking-wider">
                            Initial Intake
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Select Care Plan & Shift</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Identify your clinical needs: Nursing Home Care, Senior Caregiver, Doorstep Physiotherapy, or Home Lab Tests.
                    </p>
                    <ul class="space-y-2 text-xs text-slate-600 border-t border-slate-100 pt-3">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-brand-600 mt-0.5"></i>
                            <span>Choose duration: 8h Day Shift, 12h Shift, or 24h Live-in</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-brand-600 mt-0.5"></i>
                            <span>Specify male or female staff preference</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-brand-600 mt-0.5"></i>
                            <span>Share physician prescription or recovery guidelines</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4 hover:border-brand-500 transition-all flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded bg-emerald-50 text-emerald-600 flex items-center justify-center text-lg font-black border border-emerald-200">
                            02
                        </div>
                        <span class="text-[10px] font-bold text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded uppercase tracking-wider">
                            Screening
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Matched with Verified Staff</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Our care coordinator reviews staff profiles and pairs you with certified, background-checked professionals suited for your patient.
                    </p>
                    <ul class="space-y-2 text-xs text-slate-600 border-t border-slate-100 pt-3">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-emerald-600 mt-0.5"></i>
                            <span>Verification of BNC accreditation and clinical diplomas</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-emerald-600 mt-0.5"></i>
                            <span>Review caregiver bio, past shift history & client reviews</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-emerald-600 mt-0.5"></i>
                            <span>Clear pricing confirmation with zero surprise charges</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm space-y-4 hover:border-brand-500 transition-all flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="w-12 h-12 rounded bg-cyan-50 text-cyan-600 flex items-center justify-center text-lg font-black border border-cyan-200">
                            03
                        </div>
                        <span class="text-[10px] font-bold text-cyan-800 bg-cyan-50 px-2.5 py-1 rounded uppercase tracking-wider">
                            Active Care
                        </span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900">Supervised Care at Home</h3>
                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                        Caregiver arrives on schedule with official ID. Daily shifts, vital charts, and medications are tracked with medical supervision.
                    </p>
                    <ul class="space-y-2 text-xs text-slate-600 border-t border-slate-100 pt-3">
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-cyan-600 mt-0.5"></i>
                            <span>Daily vitals charting (BP, Pulse, SpO2, Blood Sugar)</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-cyan-600 mt-0.5"></i>
                            <span>Tele-doctor escalation for acute health changes</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i class="fa-solid fa-check text-cyan-600 mt-0.5"></i>
                            <span>Guaranteed free substitute if personnel falls ill</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- WHAT HAPPENS DURING AN ACTIVE SHIFT -->
    <div class="bg-white rounded-lg p-6 sm:p-10 border border-slate-200 shadow-sm space-y-6">
        <h3 class="text-xl font-bold text-slate-900">Clinical Protocols During Every Home Shift</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs sm:text-sm text-slate-600">
            <div class="p-4 bg-slate-50 rounded border border-slate-200 space-y-2">
                <div class="font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-clipboard-check text-brand-600"></i> Arrival & Identification Protocol
                </div>
                <p class="leading-relaxed text-slate-600">
                    The nurse or caregiver presents their official Varasa Health identification card upon arrival. Hands and equipment are sanitized before patient interaction following hospital-grade infection control standards.
                </p>
            </div>
            <div class="p-4 bg-slate-50 rounded border border-slate-200 space-y-2">
                <div class="font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-heart-pulse text-brand-600"></i> Baseline Vitals Charting
                </div>
                <p class="leading-relaxed text-slate-600">
                    Immediately upon shift commencement, baseline patient parameters (blood pressure, pulse, SpO2, temperature, and blood glucose when required) are measured and recorded in the patient care logbook.
                </p>
            </div>
            <div class="p-4 bg-slate-50 rounded border border-slate-200 space-y-2">
                <div class="font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-pills text-brand-600"></i> Medication & Procedure Execution
                </div>
                <p class="leading-relaxed text-slate-600">
                    Prescribed medications are administered strictly per doctor instructions. Clinical procedures (IV cannulation, wound dressing, catheter flushing, or tube feeding) are carried out using sterile disposable supplies.
                </p>
            </div>
            <div class="p-4 bg-slate-50 rounded border border-slate-200 space-y-2">
                <div class="font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-phone-volume text-brand-600"></i> Shift Handover & Supervisor Check-in
                </div>
                <p class="leading-relaxed text-slate-600">
                    Shift handover summary is shared with the family before departure. Our central clinical desk conducts periodic supervisor check-ins to monitor protocol adherence.
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
            <h3 class="text-xl sm:text-2xl font-bold tracking-tight">Ready to Book a Home Caregiver or Nurse?</h3>
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
