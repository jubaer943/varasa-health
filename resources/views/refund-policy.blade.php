@extends('layouts.frontend')

@section('title', 'Cancellation & Refund Policy - Varasa Health')
@section('meta_description', 'Official cancellation, shift rescheduling, and refund policies for Varasa Health home nursing, caregiver deployment, and diagnostic blood testing.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">

    <!-- Main Content Card -->
    <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-100">Cancellation & Refund Policy</h1>
        @if(!empty($refundPolicy) && !empty($refundPolicy->description))
            <div class="prose prose-sm max-w-none text-xs sm:text-sm text-slate-700 leading-relaxed space-y-4">
                {!! $refundPolicy->description !!}
            </div>
        @else
            <div class="space-y-6 text-xs sm:text-sm text-slate-700 leading-relaxed">
                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2">1. Advance Shift Cancellation Windows</h2>
                    <p class="text-slate-600 leading-relaxed">
                        To cancel or reschedule a scheduled home nursing, physiotherapy, or senior caregiver shift:
                    </p>
                    <ul class="list-disc pl-5 mt-2 space-y-1 text-slate-600">
                        <li><strong>Notice given 6+ hours before shift start:</strong> 100% full refund with zero cancellation fee, or the balance may be credited towards future care shifts.</li>
                        <li><strong>Short-notice cancellation (&lt; 6 hours before shift):</strong> A nominal caregiver mobilization fee of up to 30% may apply to compensate the nurse or attendant who has already traveled to your designated address.</li>
                    </ul>
                </div>

                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2">2. Emergency Hospitalization or Patient Admission</h2>
                    <p class="text-slate-600 leading-relaxed">
                        If a patient is unexpectedly admitted to an Intensive Care Unit (ICU) or hospital ward during an active booking period, shift billing will be immediately paused upon verbal or written notification. Any unused pre-paid days will be fully refunded or held in care credit at the family's discretion.
                    </p>
                </div>

                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2">3. Weekly and Monthly Packages (Early Termination)</h2>
                    <p class="text-slate-600 leading-relaxed">
                        Clients subscribed to weekly or monthly home care plans who choose to conclude service early will have their charges adjusted based on completed shift days at standard non-discounted rates. Any remaining balance is promptly refunded.
                    </p>
                </div>

                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2">4. Diagnostic Blood Test Cancellation</h2>
                    <p class="text-slate-600 leading-relaxed">
                        Appointments for home blood sample collections can be canceled anytime prior to the phlebotomist's dispatch with a 100% refund. Once biological samples are successfully drawn and registered into the pathology laboratory, diagnostic processing fees are non-refundable.
                    </p>
                </div>

                <div>
                    <h2 class="text-base font-bold text-slate-900 mb-2">5. Refund Processing Timelines & Methods</h2>
                    <p class="text-slate-600 leading-relaxed">
                        Approved refunds are processed within <strong>3 to 5 business days</strong> directly back to the original method of payment (bKash, Nagad, Visa/Mastercard, or direct bank transfer).
                    </p>
                </div>
            </div>
        @endif
    </div>

    <!-- Support Help Card -->
    <div class="bg-slate-100 rounded-lg p-6 space-y-3 text-xs text-slate-600 border border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Billing & Refund Assistance</h4>
            <p class="text-xs text-slate-500 mt-1">For questions regarding past payments or refund status, contact our billing desk directly.</p>
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
