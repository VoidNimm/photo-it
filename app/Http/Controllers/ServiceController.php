<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Testimonial;

class ServiceController extends Controller
{
    // Menampilkan halaman services
    public function index()
    {
        // Ambil semua layanan (sudah termasuk price di dalamnya)
        $services = Service::orderBy('id')->get();

        // Hanya ambil testimonial yang sudah approved
        $testimonials = Testimonial::where('is_approved', true)
            ->orderBy('is_featured', 'desc') // Featured dulu
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Kirim data ke view
        return view('services', [
            'services' => $services,
            'testimonials' => $testimonials,
        ]);
    }
}
