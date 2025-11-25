<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\Testimonial;

class HomeController extends Controller
{
    // Menampilkan halaman home
    public function index()
    {
        $galleryItems = GalleryItem::where('is_featured', true)
            ->orderBy('display_order')
            ->limit(8)
            ->get();

        return view('index', [
            'galleryItems' => $galleryItems,
        ]);
    }
}
