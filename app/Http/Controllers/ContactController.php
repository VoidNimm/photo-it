<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

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
        $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|min:5',
            'subject' => 'required|string|min:5',
            'message' => 'required|string|min:10',
            'phone' => 'nullable|string|min:5',
        ]);

        // simpan pesan ke database
        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'phone' => $request->phone ?? null,
            'is_read' => false,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim!');
    }
}
