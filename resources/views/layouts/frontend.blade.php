@php
    $siteSettings = $siteSettings ?? \App\Models\CmsContent::whereIn('type', [
        'contact_us',
        'helpline_number',
        'helpline_alt',
        'whatsapp_number',
        'support_email',
        'office_address',
        'service_area',
        'facebook_url',
        'linkedin_url',
        'hero_title',
        'hero_subtitle',
        'android_url',
        'ios_url',
    ])->pluck('description', 'type')->toArray();

    $helplineNumber = !empty($siteSettings['helpline_number']) ? $siteSettings['helpline_number'] : (!empty($siteSettings['contact_us']) ? $siteSettings['contact_us'] : '01859-382953');
    $helplineAlt = !empty($siteSettings['helpline_alt']) ? $siteSettings['helpline_alt'] : '01859-382253';
    $whatsappNumber = !empty($siteSettings['whatsapp_number']) ? preg_replace('/[^0-9]/', '', $siteSettings['whatsapp_number']) : '8801859382953';
    $supportEmail = !empty($siteSettings['support_email']) ? $siteSettings['support_email'] : 'support@varasahealth.com';
    $officeAddress = !empty($siteSettings['office_address']) ? $siteSettings['office_address'] : 'House 57, Road 25, Block A, Banani, Dhaka';
    $serviceArea = !empty($siteSettings['service_area']) ? $siteSettings['service_area'] : 'Serving All Zones Across Dhaka Metro';
    $facebookUrl = !empty($siteSettings['facebook_url']) ? $siteSettings['facebook_url'] : 'https://facebook.com';
    $linkedinUrl = !empty($siteSettings['linkedin_url']) ? $siteSettings['linkedin_url'] : 'https://linkedin.com';
    $heroTitle = !empty($siteSettings['hero_title']) ? $siteSettings['hero_title'] : 'Professional Healthcare & Nursing Care at Your Home';
    $heroSubtitle = !empty($siteSettings['hero_subtitle']) ? $siteSettings['hero_subtitle'] : 'Verified male & female nurses, elderly caregivers, physiotherapists, and diagnostic testing delivered directly to your doorstep in Dhaka.';
    $androidUrl = $androidUrl ?? trim($siteSettings['android_url'] ?? '');
    $iosUrl = $iosUrl ?? trim($siteSettings['ios_url'] ?? '');
    $privacyPolicy = $privacyPolicy ?? \App\Models\CmsContent::where('type', 'privacy-policy')->where('user_type', 'user')->first();
    $terms = $terms ?? \App\Models\CmsContent::where('type', 'terms-condition')->where('user_type', 'user')->first();
@endphp
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="ZXE_6upd1hwfYhp3_OSsR1dWYH7mnYGmLXbfOYajG9k" />
    <meta name="description"
        content="@yield('meta_description', 'Varasa Health Home Service - Certified nurses, elderly caregivers, physiotherapists, doctor consultations, and diagnostic tests delivered to your doorstep in Dhaka.')">
    <title>@yield('title', 'Varasa Health - Professional Home Nursing, Elderly Care & Healthcare')</title>

    <link rel="icon" href="{{ asset('assets/images/auth logo.png') }}" type="image/png">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#f0fdf9',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#00a887',
                            600: '#00876c',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                            950: '#042f2e',
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'Inter', 'sans-serif'],
                    },
                    borderRadius: {
                        'DEFAULT': '6px',
                        'sm': '4px',
                        'md': '6px',
                        'lg': '8px',
                        'xl': '12px',
                        '2xl': '16px',
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts & Font Awesome Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.94);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    @stack('styles')
    @yield('styles')
</head>

<body class="bg-slate-50 text-slate-800 antialiased selection:bg-brand-600 selection:text-white">

    <!-- HEADER & TOPBAR -->
    @include('layouts.partials.header')

    <!-- MAIN PAGE CONTENT -->
    <main id="main-view-container">
        @yield('content')
    </main>

    <!-- FLOATING WHATSAPP -->
    @include('layouts.partials.whatsapp')

    <!-- FOOTER & UNIVERSAL MODALS -->
    @include('layouts.partials.footer')

    <!-- GLOBAL FRONTEND SCRIPTS -->
    <script>
        // Mobile Menu Drawer
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        function closeMobileMenu() {
            if (mobileMenu) {
                mobileMenu.classList.add('hidden');
            }
        }

        // Privacy Modal (fallback)
        function openPrivacyModal() {
            const modal = document.getElementById('privacy-modal');
            if (modal) modal.classList.remove('hidden');
        }

        function closePrivacyModal() {
            const modal = document.getElementById('privacy-modal');
            if (modal) modal.classList.add('hidden');
        }
    </script>

    @stack('scripts')
    @yield('scripts')
</body>

</html>
