@extends('layouts.frontend')

@section('title', 'Pricing Matrix & Caregiver Rates - Varasa Health')
@section('meta_description', 'Review transparent home healthcare tariffs in Dhaka: 8h, 12h, and 24h nursing and caregiver shifts, physiotherapy fees, monthly retainer packages, and zero agency admission fees.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Pricing Matrix & Caregiver Rates</h1>
        <p class="text-slate-600 text-xs sm:text-sm mt-1">Transparent tariffs with no agency or hidden fees. Flexible 8h, 12h, 24h, and monthly retainers.</p>
    </div>

    <!-- INTERACTIVE PRICING CALCULATOR -->
    <div class="bg-slate-900 rounded-lg p-6 sm:p-10 text-white border border-slate-800 shadow-md">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <div class="lg:col-span-5 space-y-4">
                <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest bg-emerald-500/10 border border-emerald-500/30 px-2.5 py-1 rounded">
                    Interactive Estimator
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Calculate Your Estimated Care Tariff
                </h2>
                <p class="text-slate-300 text-xs sm:text-sm leading-relaxed">
                    Select your preferred shift duration and billing frequency to see exact cost estimates for certified bedside caregivers and nurses.
                </p>
                
                <div class="space-y-2 pt-2 text-xs text-slate-300">
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-emerald-400"></i>
                        <span>Zero agency registration or advance admission fees</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-emerald-400"></i>
                        <span>Complimentary substitute dispatch when caregiver takes leave</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-check text-emerald-400"></i>
                        <span>Official digital invoice compliant with corporate reimbursements</span>
                    </div>
                </div>
            </div>

            <!-- Calculator Box -->
            <div class="lg:col-span-7 bg-white text-slate-900 rounded-lg p-6 sm:p-7 shadow-sm space-y-5">
                
                <!-- Shift Options -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Shift Type</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2">
                        <button type="button" onclick="setShift('8h', 600, 16000)" id="shift-8h" class="shift-btn px-3 py-2.5 rounded border border-brand-600 bg-brand-50 text-slate-900 text-xs font-bold text-center transition-all">
                            8 Hours (Day)
                        </button>
                        <button type="button" onclick="setShift('12h', 800, 22000)" id="shift-12h" class="shift-btn px-3 py-2.5 rounded border border-slate-200 hover:border-slate-400 bg-white text-slate-700 text-xs font-bold text-center transition-all">
                            12 Hours (Day/Night)
                        </button>
                        <button type="button" onclick="setShift('24h', 1400, 38000)" id="shift-24h" class="shift-btn px-3 py-2.5 rounded border border-slate-200 hover:border-slate-400 bg-white text-slate-700 text-xs font-bold text-center transition-all">
                            24h Full Live-in
                        </button>
                        <button type="button" onclick="setShift('visit', 500, 12000)" id="shift-visit" class="shift-btn px-3 py-2.5 rounded border border-slate-200 hover:border-slate-400 bg-white text-slate-700 text-xs font-bold text-center transition-all">
                            Single Visit
                        </button>
                    </div>
                </div>

                <!-- Duration Selection -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Billing Commitment</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="flex items-center gap-2.5 p-3 rounded border border-brand-600 bg-brand-50/50 cursor-pointer">
                            <input type="radio" name="plan_type" value="daily" checked onchange="updateCalc()" class="text-brand-600 focus:ring-brand-600">
                            <div>
                                <div class="text-xs font-bold text-slate-900">Per Shift / Flexible</div>
                                <div class="text-[10px] text-slate-500">Pay as needed per day</div>
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
                        <span class="text-[10px]">Verified Staff & Free Backup Guarantee</span>
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

    <!-- DETAILED SERVICE PRICING TABLE -->
    <div class="bg-white rounded-lg p-6 sm:p-10 border border-slate-200 shadow-sm space-y-6">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2">
            <div>
                <span class="text-xs font-bold text-brand-600 uppercase tracking-widest bg-brand-50 border border-brand-200 px-2.5 py-1 rounded">
                    Comparative Rates
                </span>
                <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight mt-2">
                    Comprehensive Tariff Matrix Across All Care Services
                </h3>
            </div>
            <span class="text-xs text-slate-500">All prices in BDT (৳)</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm border-collapse">
                <thead>
                    <tr class="border-b border-slate-200 bg-slate-50 text-slate-700">
                        <th class="p-3.5 font-bold">Service Category</th>
                        <th class="p-3.5 font-bold">Standard Unit</th>
                        <th class="p-3.5 font-bold">Daily / Per-Visit Rate</th>
                        <th class="p-3.5 font-bold">Monthly Retainer</th>
                        <th class="p-3.5 font-bold">Included Inclusions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-slate-600">
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-3.5 font-semibold text-slate-900">Senior Caregiver (12h Shift)</td>
                        <td class="p-3.5">12 Hours / Day</td>
                        <td class="p-3.5 font-bold text-brand-700">৳800</td>
                        <td class="p-3.5 font-bold text-emerald-700">৳22,000 / mo</td>
                        <td class="p-3.5 text-xs text-slate-500">Hygiene, feeding, mobility, vital tracking, free replacement</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-3.5 font-semibold text-slate-900">Senior Caregiver (24h Live-in)</td>
                        <td class="p-3.5">24 Hours Round-the-clock</td>
                        <td class="p-3.5 font-bold text-brand-700">৳1,400</td>
                        <td class="p-3.5 font-bold text-emerald-700">৳38,000 / mo</td>
                        <td class="p-3.5 text-xs text-slate-500">Full day/night supervision, bed sore turning, meal assistance</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-3.5 font-semibold text-slate-900">Registered Nurse (B.Sc / Diploma)</td>
                        <td class="p-3.5">Per Procedure / 8h Shift</td>
                        <td class="p-3.5 font-bold text-brand-700">৳500 – ৳1,000</td>
                        <td class="p-3.5 font-bold text-emerald-700">Custom Package</td>
                        <td class="p-3.5 text-xs text-slate-500">IV cannula, Foley catheter, sterile wound dressing, injections</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-3.5 font-semibold text-slate-900">Physiotherapy at Home</td>
                        <td class="p-3.5">45-60 min session</td>
                        <td class="p-3.5 font-bold text-brand-700">৳700 – ৳1,200</td>
                        <td class="p-3.5 font-bold text-emerald-700">৳7,000 (10 Sessions)</td>
                        <td class="p-3.5 text-xs text-slate-500">BPT therapist, TENS electrotherapy, stroke & joint recovery</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-3.5 font-semibold text-slate-900">Diagnostic Sample Collection</td>
                        <td class="p-3.5">Doorstep Phlebotomist Visit</td>
                        <td class="p-3.5 font-bold text-brand-700">Lab Regulated + ৳200</td>
                        <td class="p-3.5 font-bold text-emerald-700">—</td>
                        <td class="p-3.5 text-xs text-slate-500">Sterile vacuum kit, cold-chain transport, digital PDF in 6-12h</td>
                    </tr>
                    <tr class="hover:bg-slate-50/50">
                        <td class="p-3.5 font-semibold text-slate-900">Doctor Video Consultation</td>
                        <td class="p-3.5">Scheduled Video Consult</td>
                        <td class="p-3.5 font-bold text-brand-700">৳400 – ৳800</td>
                        <td class="p-3.5 font-bold text-emerald-700">—</td>
                        <td class="p-3.5 text-xs text-slate-500">BMDC registered MBBS doctor, digital verified prescription</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Contact & Assistance Card -->
    <div class="bg-slate-900 text-white rounded-lg p-6 sm:p-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
        <div>
            <div class="inline-flex items-center gap-2 text-xs font-bold text-brand-400 uppercase tracking-wider mb-2">
                <i class="fa-solid fa-headset"></i> Immediate Dispatch Available
            </div>
            <h3 class="text-xl sm:text-2xl font-bold tracking-tight">Need a Customized Care Plan Quote?</h3>
            <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-xl">
                Our care coordinators are standing by 24/7 across Dhaka Metro to match verified staff to your family budget.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="inline-flex items-center gap-2 bg-white hover:bg-slate-100 text-slate-900 text-xs font-bold px-4 py-2.5 rounded transition-colors">
                <i class="fa-solid fa-phone"></i> {{ $helplineNumber }}
            </a>
            <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Hello Varasa Health, I would like to inquire about pricing packages for home care.') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded transition-colors">
                <i class="fa-brands fa-whatsapp text-sm"></i> WhatsApp Us
            </a>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
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
