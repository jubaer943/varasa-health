@extends('layouts.frontend')

@section('title', 'Terms & Conditions of Service - Varasa Health')
@section('meta_description', 'Terms and conditions governing home nursing, caregiver deployment, physiotherapy, and clinical diagnostic bookings with Varasa Health Home Service.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">

    <!-- Main Content Card -->
    <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-100">Terms & Conditions of Service</h1>
        @if(!empty($terms) && !empty($terms->description))
            <div class="prose prose-sm max-w-none text-xs sm:text-sm text-slate-700 leading-relaxed space-y-4">
                {!! $terms->description !!}
            </div>
        @else
            <div class="space-y-6 text-xs sm:text-sm text-slate-700 leading-relaxed">
                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2">1. Scope of Home Healthcare Services</h2>
                    <p class="text-slate-600 leading-relaxed">
                        Varasa Health provides qualified nursing staff, senior caregivers, physiotherapists, and diagnostic lab sample collection at the client's designated residence. Services are provided based on the patient's verified doctor prescription and clinical requirements.
                    </p>
                </div>

                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2">2. Emergency Medical Situations</h2>
                    <p class="text-slate-600 leading-relaxed">
                        Varasa Health Home Service is designed for scheduled home care, post-operative nursing, elderly assistance, and routine health checks. In the event of an acute medical emergency or sudden severe decompensation, the family or guardian must immediately transfer the patient to an ICU or emergency hospital facility.
                    </p>
                </div>

                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2">3. Booking, Rescheduling & Shift Policies</h2>
                    <p class="text-slate-600 leading-relaxed">
                        All shifts (12-hour day/night or 24-hour continuous) must be scheduled in advance via the mobile application or authorized helpline. Cancellations or shift rescheduling must be communicated at least 6 hours prior to the scheduled shift start time.
                    </p>
                </div>

                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2">4. Professional Ethics & Safe Workplace</h2>
                    <p class="text-slate-600 leading-relaxed">
                        Clients agree to provide a safe, respectful, and hygienic environment for deployed caregivers and nurses. Varasa Health reserves the right to withdraw personnel immediately if safety, security, or ethical boundaries are compromised.
                    </p>
                </div>

                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2">5. User Account and Data Deletion</h2>
                    <p class="text-slate-600 leading-relaxed">
                        Users may terminate their account and request complete erasure of their personal and healthcare booking history anytime through our dedicated <a href="{{ route('delete-account') }}" class="text-brand-600 font-bold underline">Data Deletion Portal</a>.
                    </p>
                </div>
            </div>
        @endif
    </div>

    <!-- Helpline & Contact Card -->
    <div class="bg-slate-100 rounded-lg p-6 space-y-3 text-xs text-slate-600 border border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Need Clarification Regarding Our Terms?</h4>
            <p class="text-xs text-slate-500 mt-1">Our customer support coordinator is available 24/7 to answer your questions.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-4 py-2 rounded transition-colors">
                <i class="fa-solid fa-phone"></i> {{ $helplineNumber }}
            </a>
            <a href="mailto:{{ $supportEmail }}" class="inline-flex items-center gap-2 border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold px-4 py-2 rounded transition-colors">
                <i class="fa-solid fa-envelope"></i> {{ $supportEmail }}
            </a>
        </div>
    </div>

</div>
@endsection
