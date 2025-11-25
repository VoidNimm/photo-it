<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        // Get settings
        $pageTitle = Setting::get('about_page_title', 'About');
        $pageSubtitle = Setting::get('about_page_subtitle', 'Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.');
        $ctaText = Setting::get('about_page_cta_text', 'Available for Hire');
        $ctaUrl = Setting::get('about_page_cta_url', '/contact');
        
        $companyImage = Setting::get('about_company_image');
        $companyTitle = Setting::get('about_company_title', 'Professional Photography Company');
        $companySubtitle = Setting::get('about_company_subtitle', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.');
        $companyInfo = Setting::get('about_company_info', []);
        $companyDesc1 = Setting::get('about_company_description_1', '');
        $companyDesc2 = Setting::get('about_company_description_2', '');
        
        $testimonialsTitle = Setting::get('about_testimonials_title', 'Testimonials');
        $testimonialsSubtitle = Setting::get('about_testimonials_subtitle', 'What they are saying');

        // Get testimonials from database (sama seperti di services)
        $testimonials = Testimonial::where('is_approved', true)
            ->orderBy('is_featured', 'desc') // Featured dulu
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('about', [
            'pageTitle' => $pageTitle,
            'pageSubtitle' => $pageSubtitle,
            'ctaText' => $ctaText,
            'ctaUrl' => $ctaUrl,
            'companyImage' => $companyImage,
            'companyTitle' => $companyTitle,
            'companySubtitle' => $companySubtitle,
            'companyInfo' => $companyInfo,
            'companyDesc1' => $companyDesc1,
            'companyDesc2' => $companyDesc2,
            'testimonialsTitle' => $testimonialsTitle,
            'testimonialsSubtitle' => $testimonialsSubtitle,
            'testimonials' => $testimonials,
        ]);
    }
}