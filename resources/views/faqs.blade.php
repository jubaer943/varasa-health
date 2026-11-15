@extends('layouts.frontend')

@section('title', 'Frequently Asked Questions (FAQ) - Varasa Health')
@section('meta_description', 'Find clear answers to common questions about Varasa Health: staff vetting, shift timings, emergency replacements, home diagnostic testing, billing, and cancellations.')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-12">

    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Frequently Asked Questions</h1>
        <p class="text-slate-600 text-xs sm:text-sm mt-1">Clear answers regarding caregiver vetting, shift timings, hospital supervision, and billing.</p>
    </div>

    <!-- DYNAMIC ACCORDION FAQS -->
    <div class="space-y-3">
        @forelse($faqs as $faq)
            <div class="bg-white rounded-lg border border-slate-200 shadow-sm overflow-hidden">
                <button onclick="toggleFaq({{ $faq->id }})" class="w-full p-5 text-left font-bold text-sm sm:text-base text-slate-900 flex justify-between items-center hover:text-brand-600 transition-colors gap-3">
                    <span class="flex flex-col sm:flex-row sm:items-center gap-2">
                        @if($faq->subService)
                            <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-brand-700 bg-brand-50 border border-brand-200 px-2 py-0.5 rounded w-fit">
                                {{ $faq->subService->service_name }}
                            </span>
                        @else
                            <span class="inline-block text-[10px] font-bold uppercase tracking-wider text-slate-600 bg-slate-100 border border-slate-200 px-2 py-0.5 rounded w-fit">
                                Care Service
                            </span>
                        @endif
                        <span>{{ $faq->question }}</span>
                    </span>
                    <i id="faq-icon-{{ $faq->id }}" class="fa-solid fa-chevron-down text-xs text-slate-400 transition-transform shrink-0"></i>
                </button>
                <div id="faq-body-{{ $faq->id }}" class="hidden px-5 pb-5 text-xs sm:text-sm text-slate-600 leading-relaxed border-t border-slate-100 pt-4">
                    {{ $faq->answer }}
                </div>
            </div>
        @empty
            <div class="text-center py-12 text-slate-500 bg-white rounded-lg border border-slate-200">
                <p>No questions currently listed.</p>
            </div>
        @endforelse
    </div>

    <!-- STILL HAVE QUESTIONS CTA -->
    <div class="bg-slate-900 text-white rounded-lg p-6 sm:p-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
        <div>
            <div class="inline-flex items-center gap-2 text-xs font-bold text-brand-400 uppercase tracking-wider mb-2">
                <i class="fa-solid fa-headset"></i> We Are Here to Help
            </div>
            <h3 class="text-xl sm:text-2xl font-bold tracking-tight">Have a Specific Question About Patient Care?</h3>
            <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-xl">
                Our clinical coordinators are available 24/7 to discuss your family's exact medical situation and provide immediate guidance.
            </p>
        </div>
        <div class="flex flex-wrap items-center gap-3">
            <a href="tel:{{ preg_replace('/[^0-9]/', '', $helplineNumber) }}" class="inline-flex items-center gap-2 bg-white hover:bg-slate-100 text-slate-900 text-xs font-bold px-4 py-2.5 rounded transition-colors">
                <i class="fa-solid fa-phone"></i> {{ $helplineNumber }}
            </a>
            <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode('Hello Varasa Health, I have a question about your home care services.') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold px-4 py-2.5 rounded transition-colors">
                <i class="fa-brands fa-whatsapp text-sm"></i> WhatsApp Us
            </a>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function toggleFaq(id) {
        const body = document.getElementById('faq-body-' + id);
        const icon = document.getElementById('faq-icon-' + id);

        if (!body || !icon) return;

        if (body.classList.contains('hidden')) {
            body.classList.remove('hidden');
            icon.classList.add('rotate-180');
        } else {
            body.classList.add('hidden');
            icon.classList.remove('rotate-180');
        }
    }
</script>
@endsection
