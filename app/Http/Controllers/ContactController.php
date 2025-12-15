<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    // nyimpan pesan dari form contact
    public function send(Request $request)
    {
        // validasi data
        $validated = $request->validate([
            'name'    => ['required', 'string', 'min:3', 'max:100', 'regex:/^[A-Za-zÀ-ÿ\\s\'\\-\\.]+$/u'],
            'email'   => ['required', 'email', 'min:5', 'max:255'],
            'subject' => ['required', 'string', 'min:5', 'max:150', 'regex:/^[A-Za-z0-9À-ÿ\\s\'\\-\\.\\,\\!\\?]+$/u'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
            'phone'   => ['nullable', 'string', 'min:5', 'max:25', 'regex:/^[0-9+\\-\\s()]+$/'],
        ]);

        // simpan pesan ke database
        ContactMessage::create([
            'name' => $this->sanitizeString($validated['name']),
            'email' => filter_var($validated['email'], FILTER_SANITIZE_EMAIL),
            'subject' => $this->sanitizeString($validated['subject']),
            'message' => $this->sanitizeString($validated['message']),
            'phone' => $validated['phone'] ? $this->sanitizePhone($validated['phone']) : null,
            'is_read' => false,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim!');
    }

    private function sanitizeString(string $value): string
    {
        // Hapus HTML tags
        $value = strip_tags($value);
        // Trim whitespace
        $value = trim($value);
        // Hapus karakter kontrol
        $value = preg_replace('/[\x00-\x1F\x7F]/u', '', $value);
        return $value;
    }

    private function sanitizePhone(string $value): string
    {
        // Hapus karakter non-angka
        $value = preg_replace('/[^0-9+\-\s()]/', '', $value);
        // Trim whitespace
        $value = trim($value);
        return $value;
    }
}
