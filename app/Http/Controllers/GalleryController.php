<?php

namespace App\Http\Controllers;

use App\Models\GalleryCategory;
use App\Models\GalleryItem;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    // Menampilkan semua gallery dengan search dan filter
    public function index(Request $request)
    {
        $query = GalleryItem::query()->with('category');

        // Filter berdasarkan kategori
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Search berdasarkan title
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where('title', 'like', "%{$searchTerm}%");
        }

        $galleryItems = $query->orderBy('display_order')
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil semua kategori untuk filter
        $categories = GalleryCategory::where('is_active', true)
            ->orderBy('display_order')
            ->get();

        return view('gallery', [
            'galleryItems' => $galleryItems,
            'categories' => $categories,
            'selectedCategory' => $request->category,
            'searchTerm' => $request->search,
        ]);
    }
}
