@extends('layouts.frontend')

@section('title', 'Clinical Home Healthcare & Nursing Services - Varasa Health')
@section('meta_description', 'Explore verified home nursing, senior patient care, doorstep physiotherapy, and diagnostic blood tests across Dhaka Metro. Hospital-grade care in the comfort of your home.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Our Healthcare & Caregiver Services</h1>
        <p class="text-slate-600 text-xs sm:text-sm mt-1">Hospital-grade medical care, certified nursing, elderly companionship, and home diagnostics delivered to your doorstep.</p>
    </div>

    <!-- SERVICES CATALOG -->
    <div class="space-y-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div>
                <span class="text-xs font-bold text-brand-600 uppercase tracking-widest bg-brand-50 border border-brand-200 px-2.5 py-1 rounded">
                    Service Catalog
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight mt-2">
                    Available Home Healthcare Solutions
                </h2>
            </div>
            <p class="text-xs text-slate-500 max-w-md">
                Each service adheres strictly to treating physician instructions, DGHS safety guidelines, and clinical infection control protocols.
            </p>
        </div>

        <!-- Dynamic Service Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($services as $service)
                @php
                    $minFee = $service->subServices->where('service_fee', '>', 0)->min('service_fee');
                    $activeSubServices = $service->subServices;
                    
                    // Clinical descriptions per service
                    $defaultDescriptions = [
                        1 => 'Certified male and female medical assistant nurses trained in ICU, CCU, and post-surgical hospital ward care.',
                        2 => 'BPT certified physiotherapists bringing modern electrotherapy and exercise equipment directly to your bedroom.',
                        3 => 'Dedicated bedside attendants for senior family members, bedridden patients, stroke recovery, and dementia care.',
                        4 => 'Doorstep collection of blood, urine, and diagnostic pathology samples with verified laboratory digital reports.',
                    ];
                    $serviceDesc = $defaultDescriptions[$service->id] ?? 'Hospital-grade healthcare and verified clinical staff dispatched directly to your residence across Dhaka Metro.';
                @endphp

                <div class="bg-white rounded-lg p-6 border border-slate-200 shadow-sm hover:border-brand-500 transition-all flex flex-col justify-between space-y-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="w-14 h-14 bg-slate-50 border border-slate-200 rounded p-2 flex items-center justify-center overflow-hidden">
                                @if(!empty($service->banner) && file_exists(public_path('storage/' . $service->banner)))
                                    <img src="{{ asset('storage/' . $service->banner) }}" class="w-full h-full object-contain" alt="{{ $service->name }}">
                                @elseif(file_exists(public_path('assets/images/service-' . $service->id . '.png')))
                                    <img src="{{ asset('assets/images/service-' . $service->id . '.png') }}" class="w-10 h-10 object-contain" alt="{{ $service->name }}">
                                @else
                                    <div class="w-10 h-10 rounded bg-brand-50 text-brand-600 flex items-center justify-center text-lg">
                                        <i class="fa-solid fa-stethoscope"></i>
                                    </div>
                                @endif
                            </div>
                            <span class="text-[10px] font-bold text-brand-700 bg-brand-50 border border-brand-200 px-2.5 py-0.5 rounded uppercase">
                                @if($service->rate > 0)
                                    ★ {{ $service->rate }}.0 Rated
                                @else
                                    Verified Care
                                @endif
                            </span>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-slate-900">{{ $service->name }}</h3>
                            <p class="text-slate-600 text-xs mt-1.5 leading-relaxed">
                                {{ $serviceDesc }}
                            </p>
                        </div>

                        <!-- Sub-services / Procedures -->
                        <div class="space-y-2 border-t border-slate-100 pt-3 text-xs text-slate-600">
                            <div class="font-bold text-slate-900 text-[11px] uppercase tracking-wider flex items-center justify-between">
                                <span>Available Procedures:</span>
                                @if($activeSubServices->count() > 0)
                                    <span class="text-[10px] text-brand-600 font-semibold">{{ $activeSubServices->count() }} Options</span>
                                @endif
                            </div>

                            @if($activeSubServices->count() > 0)
                                <ul class="space-y-1.5">
                                    @foreach($activeSubServices->take(4) as $sub)
                                        <li class="flex items-start gap-2">
                                            <i class="fa-solid fa-check text-brand-600 mt-0.5 text-[11px]"></i>
                                            <span>
                                                <strong>{{ $sub->service_name }}</strong>
                                                @if($sub->service_fee > 0)
                                                    <span class="text-slate-500 font-normal"> · ৳{{ number_format($sub->service_fee) }}</span>
                                                @endif
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <ul class="space-y-1.5">
                                    <li class="flex items-start gap-2">
                                        <i class="fa-solid fa-check text-brand-600 mt-0.5 text-[11px]"></i>
                                        <span>Doorstep certified phlebotomist sample collection</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fa-solid fa-check text-brand-600 mt-0.5 text-[11px]"></i>
                                        <span>Sterile vacuum blood & urine collection containers</span>
                                    </li>
                                    <li class="flex items-start gap-2">
                                        <i class="fa-solid fa-check text-brand-600 mt-0.5 text-[11px]"></i>
                                        <span>Digital PDF report delivery to app within 6-12 hours</span>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex items-center justify-between gap-3">
                        <div>
                            <span class="text-[10px] text-slate-400 block uppercase font-bold">Starting Rate</span>
                            <span class="text-sm font-extrabold text-slate-900">
                                @if($minFee && $minFee > 0)
                                    ৳{{ number_format($minFee) }}+
                                @else
                                    Fixed Clinical Rate
                                @endif
                            </span>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold px-3 py-2 rounded transition-colors flex items-center gap-1.5">
                                <i class="fa-solid fa-phone text-[10px]"></i> Call
                            </a>
                            <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Hello Varasa Health, I would like to book: ' . $service->name) }}" target="_blank" rel="noopener noreferrer" class="bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-3 py-2 rounded transition-colors flex items-center gap-1.5">
                                <i class="fa-brands fa-whatsapp text-xs"></i> Book
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-slate-500">
                    <p>No services currently configured.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- HOW CLINICAL SERVICE DEPLOYMENT WORKS -->
    <div class="bg-white rounded-lg p-6 sm:p-10 border border-slate-200 shadow-sm space-y-8">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <h3 class="text-xl sm:text-2xl font-extrabold text-slate-900 tracking-tight">
                Simple 3-Step Care Coordination Process
            </h3>
            <p class="text-xs sm:text-sm text-slate-500">
                How our medical coordination desk matches and deploys verified professionals to your family.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="p-5 rounded-lg bg-slate-50 border border-slate-200 space-y-2.5">
                <div class="w-8 h-8 rounded bg-brand-600 text-white font-bold flex items-center justify-center text-xs">1</div>
                <h4 class="font-bold text-sm text-slate-900">Share Patient Need</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Contact our 24/7 helpline or submit a request on WhatsApp with doctor prescription, patient clinical status, and location in Dhaka.
                </p>
            </div>

            <div class="p-5 rounded-lg bg-slate-50 border border-slate-200 space-y-2.5">
                <div class="w-8 h-8 rounded bg-brand-600 text-white font-bold flex items-center justify-center text-xs">2</div>
                <h4 class="font-bold text-sm text-slate-900">Verified Personnel Match</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    We match an experienced male or female nurse or caregiver whose profile and clinical skills fit your patient's specific recovery plan.
                </p>
            </div>

            <div class="p-5 rounded-lg bg-slate-50 border border-slate-200 space-y-2.5">
                <div class="w-8 h-8 rounded bg-brand-600 text-white font-bold flex items-center justify-center text-xs">3</div>
                <h4 class="font-bold text-sm text-slate-900">Deployment & Oversight</h4>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Staff reports directly to your home at the scheduled hour with ID verification. Continuous supervisor check-ins guarantee peace of mind.
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
            <h3 class="text-xl sm:text-2xl font-bold tracking-tight">Need a Certified Nurse or Caregiver Today?</h3>
            <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-xl">
                Our care coordinators are standing by 24/7 to assess your patient requirements and deploy verified staff across Dhaka Metro.
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
