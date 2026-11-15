@extends('layouts.frontend')

@section('title', 'Patient & User Privacy Policy - Varasa Health')
@section('meta_description', 'Official privacy policy and data protection disclosures for patients, families, and healthcare professionals using Varasa Health Home Service.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">

    <!-- Main Content Card -->
    <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-100">Privacy Policy</h1>
        @if(!empty($privacyPolicy) && !empty($privacyPolicy->description))
            <div class="prose prose-sm max-w-none text-xs sm:text-sm text-slate-700 leading-relaxed space-y-4">
                {!! $privacyPolicy->description !!}
            </div>
        @else
            <div class="space-y-6 text-xs sm:text-sm text-slate-700 leading-relaxed">
                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2">1. Information Collection & Purpose</h2>
                    <p class="text-slate-600 leading-relaxed">
                        Varasa Health collects patient clinical vitals, medical prescription images, home address coordinates, and primary contact numbers strictly for the explicit purpose of dispatching qualified caregivers, registered nurses, and healthcare personnel to your residence.
                    </p>
                </div>

                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2">2. Google Play User Data Policy & Deletion Rights</h2>
                    <p class="text-slate-600 leading-relaxed">
                        In accordance with Google Play Console Data Safety requirements, all registered users and caregivers have the explicit right to request permanent deletion of their account, clinical notes, and booking histories. You can submit an account and personal data deletion request anytime via our public portal without requiring access to the mobile application.
                    </p>
                    <div class="mt-3">
                        <a href="{{ route('delete-account') }}" class="inline-flex items-center gap-2 text-rose-600 hover:text-rose-700 font-bold text-xs bg-rose-50 border border-rose-200 px-3.5 py-2 rounded transition-colors">
                            <i class="fa-solid fa-user-xmark"></i> Visit Data & Account Deletion Portal
                        </a>
                    </div>
                </div>

                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2">3. Medical Confidentiality & Access Control</h2>
                    <p class="text-slate-600 leading-relaxed">
                        All home nursing and caregiver procedures adhere to strict patient-confidentiality protocols. Staff members and clinical caregivers are NDA-bound healthcare personnel. We do not sell, rent, or lease personal or health data to third-party commercial marketing entities under any circumstances.
                    </p>
                </div>

                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2">4. Data Security Standards</h2>
                    <p class="text-slate-600 leading-relaxed">
                        All data transmission between the mobile application, web services, and our database is secured with modern SSL/TLS encryption. Access to patient records is strictly restricted to assigned healthcare coordinators and verified clinical staff.
                    </p>
                </div>
            </div>
        @endif
    </div>

    <!-- Contact & Compliance Box -->
    <div class="bg-slate-100 rounded-lg p-6 space-y-3 text-xs text-slate-600 border border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Privacy Officer Contact</h4>
            <p class="text-xs text-slate-500 mt-1">If you have inquiries regarding how your medical data is handled, reach out directly.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="mailto:{{ $supportEmail }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-4 py-2 rounded transition-colors">
                <i class="fa-solid fa-envelope"></i> {{ $supportEmail }}
            </a>
            <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="inline-flex items-center gap-2 border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold px-4 py-2 rounded transition-colors">
                <i class="fa-solid fa-phone"></i> {{ $helplineNumber }}
            </a>
        </div>
    </div>

</div>
@endsection
