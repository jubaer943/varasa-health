<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\CmsContent;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            try {
                if (Schema::hasTable('cms_contents')) {
                    $siteSettings = CmsContent::whereIn('type', [
                        'contact_us',
                        'helpline_number',
                        'helpline_alt',
                        'whatsapp_number',
                        'whatsapp_message',
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
                    $whatsappMessage = !empty($siteSettings['whatsapp_message']) ? $siteSettings['whatsapp_message'] : 'Hello Varasa Health, I would like to inquire about booking a home caregiver or nurse.';
                    $supportEmail = !empty($siteSettings['support_email']) ? $siteSettings['support_email'] : 'support@varasahealth.com';
                    $officeAddress = !empty($siteSettings['office_address']) ? $siteSettings['office_address'] : 'House 57, Road 25, Block A, Banani, Dhaka';
                    $serviceArea = !empty($siteSettings['service_area']) ? $siteSettings['service_area'] : 'Serving All Zones Across Dhaka Metro';
                    $facebookUrl = !empty($siteSettings['facebook_url']) ? $siteSettings['facebook_url'] : 'https://facebook.com';
                    $linkedinUrl = !empty($siteSettings['linkedin_url']) ? $siteSettings['linkedin_url'] : 'https://linkedin.com';
                    $heroTitle = !empty($siteSettings['hero_title']) ? $siteSettings['hero_title'] : 'Professional Healthcare & Nursing Care at Your Home';
                    $heroSubtitle = !empty($siteSettings['hero_subtitle']) ? $siteSettings['hero_subtitle'] : 'Verified male & female nurses, elderly caregivers, physiotherapists, and diagnostic testing delivered directly to your doorstep in Dhaka.';
                    $androidUrl = trim($siteSettings['android_url'] ?? '');
                    $iosUrl = trim($siteSettings['ios_url'] ?? '');

                    $privacyPolicy = CmsContent::where('type', 'privacy-policy')->where('user_type', 'user')->first();
                    $terms = CmsContent::where('type', 'terms-condition')->where('user_type', 'user')->first();
                    $refundPolicy = CmsContent::where('type', 'refund-policy')->where('user_type', 'user')->first();
                    $about = \App\Models\About::where('about_type', 1)->first();

                    $view->with([
                        'siteSettings' => $siteSettings,
                        'helplineNumber' => $helplineNumber,
                        'helplineAlt' => $helplineAlt,
                        'whatsappNumber' => $whatsappNumber,
                        'whatsappMessage' => $whatsappMessage,
                        'supportEmail' => $supportEmail,
                        'officeAddress' => $officeAddress,
                        'serviceArea' => $serviceArea,
                        'facebookUrl' => $facebookUrl,
                        'linkedinUrl' => $linkedinUrl,
                        'heroTitle' => $heroTitle,
                        'heroSubtitle' => $heroSubtitle,
                        'androidUrl' => $androidUrl,
                        'iosUrl' => $iosUrl,
                        'privacyPolicy' => $privacyPolicy,
                        'terms' => $terms,
                        'refundPolicy' => $refundPolicy,
                        'about' => $about,
                    ]);
                }
            } catch (\Throwable $e) {
                // Fail gracefully during migrations or CLI
            }
        });
    }
}
