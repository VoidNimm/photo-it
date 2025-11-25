<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Menampilkan halaman contact
    public function index()
    {
        // Langsung tampilkan view tanpa data
        return view('contact');
    }

    // Menyimpan pesan dari form contact
    public function send(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'phone' => 'nullable|string|max:50',
        ]);

        // Simpan pesan ke database
        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'phone' => $request->phone ?? null,
            'is_read' => false,
        ]);

        // Kembali ke halaman contact dengan pesan sukses
        return back()->with('success', 'Pesan berhasil dikirim!');
    }
}
