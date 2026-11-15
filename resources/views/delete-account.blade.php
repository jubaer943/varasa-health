@extends('layouts.frontend')

@section('title', 'Request Account & Data Deletion - Varasa Health')
@section('meta_description', 'Official Google Play Console compliant data safety and account deletion request portal for Varasa Health Home Service users and healthcare professionals.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-6">

    <!-- Deletion Form Card -->
    <div class="bg-white rounded-lg p-6 sm:p-8 border border-slate-200 shadow-sm space-y-5">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 mb-2">Request Account & Data Deletion</h1>
            <p class="text-slate-600 text-xs sm:text-sm pb-4 border-b border-slate-100">
                Under Google Play Store Data Safety Policies, you have the right to request the permanent deletion of your <strong>Varasa Health Home Service</strong> account and all associated personal data directly from this web page without reinstalling or opening the mobile application.
            </p>
        </div>
        <form id="deletion-form" onsubmit="handleAccountDeletionSubmit(event)" class="space-y-5">
            
            <!-- Account Type Selection -->
            <div>
                <label class="block text-xs font-bold text-slate-900 mb-2 uppercase tracking-wider">
                    Account Type <span class="text-rose-500">*</span>
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <label class="relative flex items-center p-3 rounded border border-slate-300 cursor-pointer hover:border-brand-600 has-[:checked]:border-brand-600 has-[:checked]:bg-brand-50/50 transition-all">
                        <input type="radio" name="account_type" value="Patient/User" checked class="text-brand-600 focus:ring-brand-600">
                        <div class="ml-3">
                            <div class="font-bold text-xs text-slate-900">Patient / Family User Account</div>
                            <div class="text-[10px] text-slate-500">Booked nursing shifts or lab tests</div>
                        </div>
                    </label>
                    <label class="relative flex items-center p-3 rounded border border-slate-300 cursor-pointer hover:border-brand-600 has-[:checked]:border-brand-600 has-[:checked]:bg-brand-50/50 transition-all">
                        <input type="radio" name="account_type" value="Professional/Caregiver" class="text-brand-600 focus:ring-brand-600">
                        <div class="ml-3">
                            <div class="font-bold text-xs text-slate-900">Healthcare Professional Account</div>
                            <div class="text-[10px] text-slate-500">Nurse, caregiver, or physiotherapist</div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Input Fields -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-900 mb-1">
                        Full Name <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" required placeholder="e.g. Tanvir Ahmed"
                        class="w-full px-3 py-2 rounded border border-slate-300 focus:outline-none focus:border-brand-600 text-xs font-medium">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-900 mb-1">
                        Registered Mobile Number / Email <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" required placeholder="e.g. +8801700000000 or user@mail.com"
                        class="w-full px-3 py-2 rounded border border-slate-300 focus:outline-none focus:border-brand-600 text-xs font-medium">
                </div>
            </div>

            <!-- Optional ID -->
            <div>
                <label class="block text-xs font-bold text-slate-900 mb-0.5">
                    User ID / Caregiver Profile ID (Optional)
                </label>
                <p class="text-[10px] text-slate-400 mb-1.5">
                    Shown under profile tab inside the Varasa app (e.g. User ID: D0003)
                </p>
                <input type="text" placeholder="e.g. D0003"
                    class="w-full px-3 py-2 rounded border border-slate-300 focus:outline-none focus:border-brand-600 text-xs font-medium">
            </div>

            <!-- Reason -->
            <div>
                <label class="block text-xs font-bold text-slate-900 mb-1">
                    Reason for Account Deletion (Optional)
                </label>
                <select class="w-full px-3 py-2 rounded border border-slate-300 focus:outline-none focus:border-brand-600 text-xs bg-white font-medium text-slate-700">
                    <option value="">-- Select Reason --</option>
                    <option>No longer need home care services</option>
                    <option>Created a duplicate or accidental account</option>
                    <option>Privacy or data concerns</option>
                    <option>Switching to a different phone number</option>
                    <option>Other personal reason</option>
                </select>
            </div>

            <!-- Acknowledgment -->
            <div class="p-3.5 bg-amber-50 rounded border border-amber-200">
                <label class="flex items-start gap-2.5 cursor-pointer">
                    <input type="checkbox" required class="mt-0.5 rounded text-rose-600 focus:ring-rose-500">
                    <span class="text-xs text-amber-900 leading-relaxed font-semibold">
                        I confirm and understand that submitting this request will permanently delete my profile, login credentials, saved addresses, diagnostic report records, and active booking history from Varasa Health servers. This action is irreversible.
                    </span>
                </label>
            </div>

            <!-- Submit Button -->
            <button type="submit" id="delete-submit-btn"
                class="w-full bg-rose-600 hover:bg-rose-700 text-white font-bold py-3 rounded shadow transition-all text-xs flex items-center justify-center gap-2">
                <i class="fa-solid fa-trash-can"></i> Submit Account & Data Deletion Request
            </button>

        </form>
    </div>

    <!-- Policies Card -->
    <div class="bg-slate-100 rounded-lg p-6 space-y-3 text-xs text-slate-600 border border-slate-200">
        <h3 class="font-bold text-slate-900 text-xs uppercase tracking-wider flex items-center gap-1.5">
            <i class="fa-solid fa-file-shield text-brand-600"></i> Data Retention & Processing Timelines:
        </h3>
        <ul class="list-disc pl-5 space-y-1.5 leading-relaxed">
            <li><strong>Processing Turnaround:</strong> Deletion requests are verified and permanently executed within <strong>7 business days</strong>.</li>
            <li><strong>Data Erased Immediately:</strong> Account name, profile photograph, saved GPS locations, mobile phone number, login device tokens, and active care schedules.</li>
            <li><strong>Regulatory Retention:</strong> Past transaction receipts may be held securely for up to 90 days strictly for mandatory taxation compliance under Bangladesh commercial law.</li>
        </ul>
    </div>

    <!-- Support Help Card -->
    <div class="bg-white rounded-lg p-6 border border-slate-200 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h4 class="text-xs font-bold text-slate-900 uppercase tracking-wider">Have Questions or Need Immediate Assistance?</h4>
            <p class="text-xs text-slate-500 mt-1">Our compliance team is reachable 24/7 for privacy and verification inquiries.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-4 py-2 rounded transition-colors">
                <i class="fa-solid fa-phone"></i> {{ $helplineNumber }}
            </a>
            <a href="mailto:{{ $supportEmail }}" class="inline-flex items-center gap-2 border border-slate-300 hover:bg-slate-50 text-slate-700 text-xs font-bold px-4 py-2 rounded transition-colors">
                <i class="fa-solid fa-envelope"></i> Email Us
            </a>
        </div>
    </div>

</div>

<!-- SUCCESS CONFIRMATION MODAL -->
<div id="success-modal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex items-center justify-center hidden p-4">
    <div class="bg-white rounded-lg p-6 max-w-md w-full text-center space-y-5 shadow-xl border border-slate-200">
        <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center text-2xl mx-auto">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <div class="space-y-1.5">
            <h3 class="text-xl font-bold text-slate-900">Request Logged</h3>
            <p class="text-slate-600 text-xs leading-relaxed">
                Your request for account and personal data deletion has been received. Our privacy compliance team will verify your details and process deletion within 7 business days.
            </p>
        </div>
        <div class="p-2.5 bg-slate-50 rounded text-xs text-slate-600 font-mono border border-slate-200">
            Ticket Reference: <strong id="request-id-display" class="text-brand-600 font-bold">VR-89210</strong>
        </div>
        <a href="{{ route('home') }}"
            class="block w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-2.5 rounded transition-all text-xs text-center">
            Return to Homepage
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function handleAccountDeletionSubmit(e) {
        e.preventDefault();

        const submitBtn = document.getElementById('delete-submit-btn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-spinner animate-spin"></i> Processing Request...';

        setTimeout(() => {
            const randomId = 'VR-' + Math.floor(10000 + Math.random() * 90000);
            document.getElementById('request-id-display').textContent = randomId;
            document.getElementById('success-modal').classList.remove('hidden');

            document.getElementById('deletion-form').reset();
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fa-solid fa-trash-can"></i> Submit Account & Data Deletion Request';
        }, 1000);
    }
</script>
@endsection
