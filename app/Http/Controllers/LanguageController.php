<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
    public function switch(Request $request, string $locale): RedirectResponse
    {
        // Validasi locale
        if (!in_array($locale, ['en', 'id'])) {
            $locale = config('app.locale');
        }
        
        // Simpan ke session
        session(['locale' => $locale]);
        
        // Redirect kembali ke halaman sebelumnya
        return redirect()->back();
    }
}
